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
        Schema::create('employee_salaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('salary_grade_id');
            $table->unsignedBigInteger('salary_step_id');
            $table->decimal('motorcycle_loan', 8, 2)->default(0);
            $table->decimal('pf_loan', 8, 2)->default(0);
            $table->decimal('laptop_loan', 8, 2)->default(0);
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('employees');
            $table->foreign('salary_grade_id')->references('id')->on('salary_grades');
            $table->foreign('salary_step_id')->references('id')->on('salary_steps');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_salaries');
    }
};
