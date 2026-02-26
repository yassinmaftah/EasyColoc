<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ColocationController extends Controller
{
    public function index()
    {
        $colocations = Colocation::whereHas('memberships', function ($query) {
            $query->where('user_id', Auth::id());
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
        $activeMembership = Membership::where('user_id', Auth::id())
            ->whereNull('left_at')
            ->whereHas('colocation', function ($query) {
                $query->where('status', 'active');
            })
            ->first();

        $activeColocation = null;

        if ($activeMembership)
            $activeColocation = Colocation::with('memberships.user')->find($activeMembership->colocation_id);

        return view('user-dashboard', compact('activeColocation'));
    }
}
