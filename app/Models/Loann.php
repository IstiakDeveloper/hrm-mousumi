<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loann extends Model
{
    use HasFactory;
    protected $fillable = ['employee_id', 'loan_type', 'amount', 'validity', 'monthly_payment'];
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
