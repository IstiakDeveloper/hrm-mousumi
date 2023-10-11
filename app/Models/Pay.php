<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'month',
        'amount_paid',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
