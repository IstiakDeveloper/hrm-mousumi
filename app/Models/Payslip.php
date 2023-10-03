<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payslip extends Model
{
    use HasFactory;
    public function payslipType()
    {
        return $this->belongsTo(PayslipType::class);
    }
}
