<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payslip extends Model
{
    use HasFactory;
    protected $fillable = ['employee_id', 'payslip_type_id', 'basic_salary'];
    public function payslip_type()
    {
        return $this->belongsTo(PayslipType::class, 'payslip_type_id');
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
