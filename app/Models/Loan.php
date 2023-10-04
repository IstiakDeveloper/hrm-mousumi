<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'type', 'loan_amount', 'employee_id', 'loan_option_id'];

    public function loanOption()
    {
        return $this->belongsTo(LoanOption::class, 'loan_option_id');
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
