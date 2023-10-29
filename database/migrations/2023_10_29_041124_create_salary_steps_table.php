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
        Schema::create('salary_steps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('salary_grade_id')->constrained('salary_grades');
            $table->string('step_name');
            $table->integer('basic_salary');
            $table->integer('home_rents');
            $table->integer('medical_allowance');
            $table->integer('conveyance');
            $table->integer('lunch');
            $table->integer('mobile');
            $table->integer('special_allowance')->nullable();
            $table->integer('festival_bonus')->nullable();
            $table->integer('total_salary');
            $table->integer('pf_fund');
            $table->integer('motorcycle_loan');
            $table->integer('pf_loan');
            $table->integer('laptop_loan');
            $table->integer('staff_welfare');
            $table->integer('tax');
            $table->integer('total_deduction');
            $table->integer('net_salary');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary_steps');
    }
};
