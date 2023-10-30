<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryStep extends Model
{
    use HasFactory;
    protected $fillable = [
        'salary_grade_id',
        'step_name',
        'basic_salary',
        'home_rents',
        'medical_allowance',
        'conveyance',
        'lunch',
        'mobile',
        'special_allowance',
        'festival_bonus',
        'total_salary',
        'pf_fund',
        'motorcycle_loan',
        'pf_loan',
        'laptop_loan',
        'staff_welfare',
        'tax',
        'total_deduction',
        'net_salary',
    ];

    public function grade()
    {
        return $this->belongsTo(SalaryGrade::class, 'salary_grade_id');
    }
    public function salaryGrade()
    {
        return $this->belongsTo(SalaryGrade::class);
    }

    public function employeeSalaries()
    {
        return $this->hasMany(EmployeeSalary::class);
    }
}
