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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('branch');
            $table->unsignedBigInteger('job_category_id');
            $table->integer('number_of_positions');
            $table->string('status');
            $table->date('start_date');
            $table->date('end_date');
            $table->text('skills');
            $table->string('gender');
            $table->boolean('dob_required')->default(false);
            $table->boolean('address_required')->default(false);
            $table->boolean('profile_image_required')->default(false);
            $table->boolean('resume_required')->default(false);
            $table->boolean('cover_letter_required')->default(false);
            $table->text('description');
            $table->text('requirements');
            $table->timestamps();

            $table->foreign('job_category_id')->references('id')->on('job_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
