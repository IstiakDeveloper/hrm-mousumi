<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanOption extends Model
{
    use HasFactory;
    protected $fillable = ['loan_option'];
    public function salaries()
    {
        return $this->hasMany(Salary::class);
    }
}
