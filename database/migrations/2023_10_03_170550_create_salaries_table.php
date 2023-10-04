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
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->unsignedBigInteger('allowance_option_id')->nullable();
            $table->foreign('allowance_option_id')->references('id')->on('allowance_options')->onDelete('set null');
            $table->unsignedBigInteger('loan_option_id')->nullable();
            $table->foreign('loan_option_id')->references('id')->on('loan_options')->onDelete('set null');
            $table->unsignedBigInteger('deduction_option_id')->nullable();
            $table->foreign('deduction_option_id')->references('id')->on('deduction_options')->onDelete('set null');
            $table->unsignedBigInteger('payslip_type_id')->nullable();
            $table->foreign('payslip_type_id')->references('id')->on('payslip_types')->onDelete('set null');
            $table->decimal('salary', 10, 2)->nullable();
            $table->decimal('net_salary', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salaries');
    }
};
