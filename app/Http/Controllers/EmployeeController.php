<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index()
    {     
        // $employees = Employee::paginate(1);        
        $employees = Employee::all(); //Select * from employees
        return view ('/dashboard', ['employees'=>$employees]);
    }
}
