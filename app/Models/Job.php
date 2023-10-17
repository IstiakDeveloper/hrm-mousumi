<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'branch',
        'job_category_id',
        'number_of_positions',
        'status',
        'start_date',
        'end_date',
        'skills',
        'gender',
        'dob_required',
        'address_required',
        'profile_image_required',
        'resume_required',
        'cover_letter_required',
        'description',
        'requirements',
    ];

    public function jobCategory()
    {
        return $this->belongsTo(JobCategory::class);
    }

    public function jobApplications()
    {
        return $this->hasMany(JobApplication::class);
    }
}
