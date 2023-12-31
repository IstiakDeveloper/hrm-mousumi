<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayslipType extends Model
{
    use HasFactory;
    protected $fillable = ['payslip_type'];
    public function salaries()
    {
        return $this->hasMany(Salary::class);
    }
}
