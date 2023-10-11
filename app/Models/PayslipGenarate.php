<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayslipGenarate extends Model
{
    use HasFactory;
    protected $table = 'payslip';
    protected $fillable = [
        'employee_id',
        'month',
        'amount_paid',
        'paid',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function pay()
    {
        return $this->hasOne(Pay::class, 'month', 'month')->where('employee_id', $this->employee_id);
    }
}
