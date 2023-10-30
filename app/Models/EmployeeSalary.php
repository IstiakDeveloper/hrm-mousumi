<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeSalary extends Model
{
    use HasFactory;
    protected $fillable = ['motorcycle_loan', 'pf_loan', 'laptop_loan', 'salary_grade_id', 'salary_step_id', 'employee_id'];
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function salaryGrade()
    {
        return $this->belongsTo(SalaryGrade::class);
    }

    public function salaryStep()
    {
        return $this->belongsTo(SalaryStep::class);
    }
}
