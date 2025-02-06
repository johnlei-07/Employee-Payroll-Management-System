<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    //
    protected $table = 'employees';
    protected $fillable = [
        'Name',
        'Employee_id',
        'Phone',
        'Address',
        'WorkingStatus',
        'Department',
        'BasicSalary',
        'NumDays',
        'OverTime',
        'Bonus',
        'TaxDeduction',
        'InsuranceDeduction',
        'NetSalary',
        'Total',
        'PayslipStart',
        'PayslipEnd',
        'PayslipMonthYear'
    ];
    public function user()
{
    return $this->belongsTo(User::class);
}
}
