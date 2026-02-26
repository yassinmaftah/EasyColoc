<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Expense;
use App\Models\ExpenseDetail;
use App\Models\Membership;

class ExpenseController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'colocation_id' => 'required|exists:colocations,id',
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'category_id' => 'nullable|exists:categories,id',
            'payer_id' => 'required|exists:users,id',
            'expense_date' => 'required|date',
        ]);

        $userMembership = Membership::where('user_id', Auth::id())
            ->where('colocation_id', $request->colocation_id)
            ->whereNull('left_at')
            ->firstOrFail();

        if ($userMembership->role === 'owner')
            $payerId = $request->payer_id;
        else
            $payerId = Auth::id();

        $activeMembers = Membership::where('colocation_id', $request->colocation_id)
            ->whereNull('left_at')
            ->get();

        $numberOfMembers = $activeMembers->count();

        $splitAmount = $request->amount / $numberOfMembers;

        DB::transaction(function () use ($request, $payerId, $activeMembers, $splitAmount) {

            $expense = Expense::create([
                'colocation_id' => $request->colocation_id,
                'payer_id' => $payerId,
                'category_id' => $request->category_id,
                'title' => $request->title,
                'amount' => $request->amount,
                'expense_date' => $request->expense_date,
            ]);

            foreach ($activeMembers as $member)
            {
                if ($member->user_id == $payerId)
                    $status = 'paid';
                else
                    $status = 'unpaid';
                ExpenseDetail::create([
                    'expense_id' => $expense->id,
                    'debtor_id' => $member->user_id,
                    'amount' => $splitAmount,
                    'status' => $status,
                ]);
            }
        });

        return back()->with('success', 'Expense added');
    }

    public function markAsPaid($id)
    {
        $detail = ExpenseDetail::findOrFail($id);
        $detail->update(['status' => 'paid']);

        return back()->with('success', 'Expense is paid');
    }
}
