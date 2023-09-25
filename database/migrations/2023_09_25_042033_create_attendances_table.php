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
        Schema::create('attendances', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('employee_id');
            $table->date('date');
            $table->enum('status', ['Present', 'Absent']);
            $table->time('clock_in')->nullable();
            $table->time('clock_out')->nullable();
            $table->integer('late_minutes')->default(0);
            $table->integer('early_leaving_minutes')->default(0);
            $table->integer('overtime_minutes')->default(0);
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
