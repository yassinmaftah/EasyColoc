<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use App\Models\Membership;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\ExpenseDetail;

class ColocationController extends Controller
{
    public function index()
    {
        $colocations = Colocation::whereHas('memberships', function ($query) {
            $query->where('user_id', Auth::id())
            ->whereNull('left_at');
        })
        ->orderBy('created_at', 'desc')
        ->get();

        return view('colocations', compact('colocations'));
    }


    public function store(Request $request)
    {
        $hasActiveColocation = Membership::where('user_id', Auth::id())
            ->whereNull('left_at')
            ->whereHas('colocation', function ($query) {
                $query->where('status', 'active');
            })
            ->exists();

        if ($hasActiveColocation) {
            return redirect()->route('colocations.index')
                ->with('error', 'You can not have two or more colocations in the same time.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        DB::transaction(function () use ($validated) {
            $colocation = Colocation::create([
                'name' => $validated['name'],
                'created_by' => Auth::id(),
                'status' => 'active',
            ]);

            Membership::create([
                'user_id' => Auth::id(),
                'colocation_id' => $colocation->id,
                'role' => 'owner',
                'joined_at' => now(),
            ]);
        });

        return redirect()->route('colocations.index')
            ->with('success', 'La colocation a été créée avec succès !');
    }

public function dashboard()
    {
        $activeMembership = null;
        $activeColocation = null;
        $myPendingDetails = [];
        $owedToMeDetails = [];
        $allPendingDetails = [];

        $membership = Membership::where('user_id', Auth::id())
            ->whereNull('left_at')
            ->first();

        if ($membership)
        {
            $colocation = Colocation::find($membership->colocation_id);

            if ($colocation && $colocation->status === 'active')
            {
                $activeMembership = $membership;

                $activeColocation = Colocation::with([
                    'memberships' => function($query) {
                        $query->whereNull('left_at');
                    },
                    'memberships.user',
                    'categories',
                    'expenses.payer',
                    'expenses.category'
                ])->find($colocation->id);

                $activeColocation->expenses = $activeColocation->expenses->sortByDesc('expense_date');
                $expenseIds = Expense::where('colocation_id', $activeColocation->id)->pluck('id');

                $myPendingDetails = ExpenseDetail::with(['expense.payer', 'debtor'])
                    ->where('debtor_id', Auth::id())
                    ->where('status', 'unpaid')
                    ->whereIn('expense_id', $expenseIds)
                    ->orderBy('created_at', 'desc')
                    ->get();

                $owedToMeDetails = ExpenseDetail::with(['expense.payer', 'debtor'])
                    ->whereHas('expense', function($query) {
                        $query->where('payer_id', Auth::id());
                    })
                    ->where('debtor_id', '!=', Auth::id())
                    ->where('status', 'unpaid')
                    ->whereIn('expense_id', $expenseIds)
                    ->orderBy('created_at', 'desc')
                    ->get();

                if ($activeMembership->role === 'owner') {
                    $allPendingDetails = ExpenseDetail::with(['expense.payer', 'debtor'])
                        ->where('status', 'unpaid')
                        ->whereIn('expense_id', $expenseIds)
                        ->get();
                }
            }
        }

        return view('user-dashboard', compact('activeColocation', 'activeMembership', 'myPendingDetails', 'owedToMeDetails', 'allPendingDetails'));
    }

}
