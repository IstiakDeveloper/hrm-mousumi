<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allowance extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'type', 'amount', 'employee_id', 'allowance_option_id'];

    public function allowanceOption()
    {
        return $this->belongsTo(AllowanceOption::class);
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
