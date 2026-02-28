<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Membership;
use App\Models\ExpenseDetail;
use App\Models\User;

class MembershipController extends Controller
{
    public function leave(Request $request)
    {
        $user = Auth::user();

        $membership = Membership::where('user_id', $user->id)
            ->whereNull('left_at')
            ->first();

        if (!$membership)
            return back()->with('error', 'Vous n\'êtes dans aucune colocation active.');

        $colocationId = $membership->colocation_id;

        if ($membership->role === 'owner') {
            $otherActiveMembers = Membership::where('colocation_id', $colocationId)
                ->whereNull('left_at')
                ->where('user_id', '!=', $user->id)
                ->count();

            if ($otherActiveMembers > 0)
                return back()->with('error', 'You can not leaving this colocation now.');

            $membership->update(['left_at' => now()]);
            return redirect()->route('user-dashboard')->with('success', 'You have left the colocation.');
        }

        $ownerMembership = Membership::where('colocation_id', $colocationId)
            ->where('role', 'owner')
            ->first();

        DB::transaction(function () use ($user, $membership, $colocationId, $ownerMembership) {

            $all_unpaid = ExpenseDetail::where('debtor_id', $user->id)
                ->where('status', 'unpaid')
                ->whereHas('expense', function($query) use ($colocationId) {
                    $query->where('colocation_id', $colocationId);
                })->sum('amount');

            if ($all_unpaid > 0)
                $user->reputation -= 1;
            else
                $user->reputation += 1;

            $user->save();

            if ($ownerMembership && $all_unpaid > 0)
            {
                ExpenseDetail::where('debtor_id', $user->id)
                    ->where('status', 'unpaid')
                    ->whereHas('expense', function($query) use ($colocationId) {
                        $query->where('colocation_id', $colocationId);
                    })
                    ->update(['debtor_id' => $ownerMembership->user_id]);
            }

            $membership->update(['left_at' => now()]);

        });

        return redirect()->route('user.dashboard')->with('success', 'You have successfully left the colocation.');
    }
}
