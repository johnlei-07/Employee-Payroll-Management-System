<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->unsignedBigInteger('Employee_id')->unique(); // Use unsignedBigInteger for consistency
            $table->bigInteger('Phone');
            $table->string('Address');
            $table->string('WorkingStatus');
            $table->string('Department');

            $table->decimal('BasicSalary', 10, 2);
            $table->integer('NumDays');
            $table->decimal('OverTime', 10, 2);
            $table->decimal('Bonus', 10, 2);

            $table->decimal('TaxDeduction', 10, 2);
            $table->decimal('InsuranceDeduction', 10, 2);
            $table->decimal('NetSalary', 10, 2);
            $table->decimal('Total', 10, 2);

            $table->date('PayslipStart'); // Start date of the payslip
            $table->date('PayslipEnd');   // End date of the payslip
            $table->string('PayslipMonthYear'); // Format: Month-Year

            $table->foreign('Employee_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
