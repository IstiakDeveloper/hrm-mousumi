<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'name',
        'email',
        'phone',
        'cover_letter',
        'gender',
        'date_of_birth',
        'address',
        'profile_image',
        'resume',
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
