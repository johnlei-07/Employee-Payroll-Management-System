<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $employees = Employee::all();
        $users = User::all();
        return view('auth.admin.admins',['employees'=> $employees, 'users' => $users]);
    }

    public function create(){
        return view('auth.admin.create_admin');
    }

    public function store(Request $request){
        try{
            $request->validate([
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:App\Models\User,email'],
                'password' => ['nullable', 'confirmed', Rules\Password::defaults()],      
            ]);

        DB::transaction(function() use ($request){
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'usertype' => 'admin'
            ]);
        });
        return redirect()->route('auth.admin.admins')->with('success_created', 'Successfully Admin Created');

        }catch(\Exception $e){
            Log::error('Registration failed: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Registration failed. Please try again.']);
        }

    }

    public function delete(string $userId){
        // Find the user by ID
        $user = User::findOrFail($userId);
        $user->delete();

        return redirect()->route('auth.admin.admins')->with('success_deleted', 'Successfully Admin Deleted');
    }

    public function edit(string $userId){
        $user = User::findOrFail($userId);
        return view('auth.admin.update_admin', ['user' => $user]);
    }

    public function update(Request $request, string $userId){
        $user = User::findOrFail($userId);

        try{
            $request->validate([
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],   
                'password_confirmation' => ['required', 'same:password'], // Check if passwords match   
            ]);
            DB::transaction(function() use ($request, $user){
                $user->update([
                    'email' => $request->input('email'),
                    'password' => $request->input('password') ? Hash::make($request->input('password')) : $user->password,
                ]);
                $user->save();
                $user->update($request->all());
            });
            return redirect()->route('auth.admin.admins')->with('success_updated', 'Successfully Admin Updated');

        }catch(\Exception $e){
            return back()->withErrors(['error' => 'Updating failed. Please try again.']);
        }
    }
}
