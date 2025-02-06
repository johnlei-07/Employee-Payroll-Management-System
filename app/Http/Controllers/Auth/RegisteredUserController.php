<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function index(){
        $employees = Employee::all();
        $users = User::all();
        return view('auth.admin.employees', ['employees' => $employees, 'users' => $users]);

    }
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
{
    try{
        $request->validate([
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:App\Models\User,email'],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],      
        ]);
        DB::transaction(function () use ($request) {
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'usertype' => 'employee'
            ]);
            

                $basicSalary = (float)$request->BasicSalary;
                $numDays = (int)$request->Numdays;
                $overTime = (float)$request->OverTime;
                $bonus = (float)$request->Bonus;
                $taxRate = 0.1; // Example: 10% tax
                $insuranceRate = 0.05; // Example: 5% insurance

                $totalEarnings = ($basicSalary * $numDays) + $overTime + $bonus;
                $taxDeduction = $totalEarnings * $taxRate;
                $insuranceDeduction = $totalEarnings * $insuranceRate;
                $netSalary = $totalEarnings - ($taxDeduction + $insuranceDeduction);

                $Total = ($basicSalary * $numDays) + $overTime + $bonus;  
                $payslipMonthYear = date('F-Y', strtotime($request->PayslipStart));
              
                $user->employees()->create([
                    'Name' => $request->Name,
                    'Phone' => $request->Phone,
                    'Address' => $request->Address,
                    'WorkingStatus' => $request->WorkingStatus,
                    'Department' => $request->Department,
                    'BasicSalary' => $request->BasicSalary,
                    'NumDays' => $request->Numdays,
                    'OverTime' => $request->OverTime,
                    'Bonus' => $request->Bonus,
                    'TaxDeduction' => $taxDeduction,
                    'InsuranceDeduction' => $insuranceDeduction,
                    'NetSalary' => $netSalary,
                    'Total' => $Total,
                    'PayslipStart' => $request->PayslipStart,
                    'PayslipEnd' => $request->PayslipEnd,
                    'PayslipMonthYear' => $payslipMonthYear,
                ]);
            
            event(new Registered($user));
            // Auth::login($user);
        });

        return redirect()->route('auth.admin.employees')->with('success_created', 'Successfully Created');
        
    }catch (\Exception $e) {
        Log::error('Registration failed: ' . $e->getMessage());
        return back()->withErrors(['error' => 'Registration failed. Please try again.']);
    }

}
    public function edit(string $userId){
        $user = User::with('employees')->find($userId);
        return view('auth.admin.update', ['user'=> $user]);
    }

    public function update(Request $request, string $userId){
        $user = User::with('employees')->find($userId);
        
        try{
            $request->validate([
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],   
                'password_confirmation' => ['required', 'same:password'], // Check if passwords match   
            ]);

            DB::transaction(function () use ($request, $user) {
                 // Update User details
                 $user->update([
                    'email' => $request->input('email'),
                    'password' => $request->input('password') ? Hash::make($request->input('password')) : $user->password,
                ]);
                $user->save();
                $user->update($request->all()); //Updates database records 

                  // Update Employee details
                 

                  $basicSalary = (float)$request->BasicSalary;
                  $numDays = (int)$request->Numdays;
                  $overTime = (float)$request->OverTime;
                  $bonus = (float)$request->Bonus;
                  $taxRate = 0.1; // Example: 10% tax
                  $insuranceRate = 0.05; // Example: 5% insurance

                $totalEarnings = ($basicSalary * $numDays) + $overTime + $bonus;
                $taxDeduction = $totalEarnings * $taxRate;
                $insuranceDeduction = $totalEarnings * $insuranceRate;
                $netSalary = $totalEarnings - ($taxDeduction + $insuranceDeduction);

                $Total = ($basicSalary * $numDays) + $overTime + $bonus;  
                
                $user->employees()->update([
                  'Name' => $request->Name,
                    'Phone' => $request->Phone,
                    'Address' => $request->Address,
                    'WorkingStatus' => $request->WorkingStatus,
                    'Department' => $request->Department,
                    'BasicSalary' => $request->BasicSalary,
                    'NumDays' => $request->Numdays,
                    'OverTime' => $request->OverTime,
                    'Bonus' => $request->Bonus,
                    'TaxDeduction' => $taxDeduction,
                    'InsuranceDeduction' => $insuranceDeduction,
                    'NetSalary' => $netSalary,
                    'Total' => $Total,
                    'PayslipStart' => $request->PayslipStart,
                    'PayslipEnd' => $request->PayslipEnd,
                    'PayslipMonthYear' => date('F-Y', strtotime($request->PayslipStart)),
                ]);

            });
             return redirect(route('auth.admin.view'), $user->id)->with('success_updated', 'Employee details updated successfully.');
        }catch(\Exception $e){
            return back()->withErrors(['error' => 'Updating failed. Please try again.']);
        }

    }

    public function delete(string $userId){
        $user = User::with('employees')->find($userId);
        $user->delete();

        return redirect()->route('auth.admin.employees')->with('success_deleted', 'Successfully Deleted');

    }
}
