<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deduction extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'type', 'deduction_amount', 'employee_id', 'deduction_option_id'];

    public function deductionOption()
    {
        return $this->belongsTo(DeductionOption::class);
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
