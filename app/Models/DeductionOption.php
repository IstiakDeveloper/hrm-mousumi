<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeductionOption extends Model
{
    use HasFactory;
    protected $fillable = ['deduction_option'];
    public function salaries()
    {
        return $this->hasMany(Salary::class);
    }
}
