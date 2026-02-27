<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membership;
use App\Models\Colocation;
use App\Models\Invitation;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ColocationInvitation;

class InvitationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $membership = Membership::where('user_id', Auth::id())
            ->whereNull('left_at')
            ->first();

        if (!$membership || $membership->role !== 'owner')
            return back()->with('error', 'You don\'t have permission to send the invitation.');

        $token = Str::random(32);

        Invitation::create([
            'colocation_id' => $membership->colocation_id,
            'email' => $request->email,
            'token' => $token,
            'status' => 'pending'
        ]);

        $colocation = Colocation::find($membership->colocation_id);
        Mail::to($request->email)->send(new ColocationInvitation($colocation, $token));

        return back()->with('success', 'Invitation send to  ' . $request->email);
    }

    public function accept($token)
    {
        $invitation = Invitation::where('token', $token)->first();

        if (!$invitation || $invitation->status !== 'pending')
            return redirect()->route('user.dashboard')->with('error', 'This invitation is invalid or has already been used.');

        $user = Auth::user();

        $existingMembership = Membership::where('user_id', $user->id)
            ->whereNull('left_at')
            ->whereHas('colocation', function($query) {
                $query->where('status', 'active');
            })
            ->first();

        if ($existingMembership)
            return redirect()->route('user.dashboard')->with('error', 'You cannot join this colocation because you are already in an active one!');

        $invitation->update(['status' => 'accepted']);

        Membership::create([
            'user_id' => $user->id,
            'colocation_id' => $invitation->colocation_id,
            'role' => 'member',
            'joined_at' => now(),
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Welcome to your new colocation!');
    }
}
