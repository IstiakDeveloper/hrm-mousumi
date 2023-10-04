<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;
    protected $fillable = ['employee_id', 'allowance_option_id', 'loan_option_id', 'deduction_option_id', 'payslip_type_id', 'salary', 'net_salary'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function allowanceOption()
    {
        return $this->belongsTo(AllowanceOption::class);
    }

    public function loanOption()
    {
        return $this->belongsTo(LoanOption::class);
    }

    public function deductionOption()
    {
        return $this->belongsTo(DeductionOption::class);
    }

    public function payslipType()
    {
        return $this->belongsTo(PayslipType::class);
    }
}
