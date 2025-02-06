<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ViewController extends Controller
{
    public function view($userId)
    {
        // Get the specific user by ID
        $user = User::with('employees')->find($userId);
        if (!$user) {
            return redirect()->route('home')->with('error', 'User not found.');
        }

        // Pass the user data to the view
        return view('auth.admin.view', ['user' => $user]);
    }
}
