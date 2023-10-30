<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryGrade extends Model
{
    use HasFactory;
    protected $fillable = [
        'grade_name',
    ];

    public function steps()
    {
        return $this->hasMany(SalaryStep::class);
    }
    public function designations()
    {
        return $this->hasMany(Designation::class, 'salary_grade_id');
    }
    public function salarySteps()
    {
        return $this->hasMany(SalaryStep::class);
    }
}
