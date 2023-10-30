<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    protected $fillable = ['name', 'job_description', 'department_id', 'salary_grade_id'];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
    public function salaryGrade()
    {
        return $this->belongsTo(SalaryGrade::class);
    }

    public function salarySteps()
    {
        return $this->salaryGrade->hasMany(SalaryStep::class);
    }

}

