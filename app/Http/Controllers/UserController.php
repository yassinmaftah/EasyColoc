<?php

namespace App\Http\Controllers;

use App\Models\User;
// use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'asc')->paginate(10);

        $totalUsers = User::count();
        $bannedUsers = User::where('is_banned', true)->count();

        return view('admin-dashboard', compact('users', 'totalUsers', 'bannedUsers'));
    }

    public function ban($id)
    {
        $user = User::findOrFail($id);

        if ($user->is_global_admin)
            return redirect()->back()->with('error', 'Impossible de bannir un administrateur global.');

        $user->is_banned = true;
        $user->save();

        return redirect()->back()->with('success', "L'utilisateur {$user->name} a été banni.");
    }

    public function unban($id)
    {
        $user = User::findOrFail($id);
        $user->is_banned = false;
        $user->save();
        return redirect()->back()->with('success', "L'utilisateur {$user->name} a été débanni.");
    }
}
