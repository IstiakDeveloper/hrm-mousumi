<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllowanceOption extends Model
{
    use HasFactory;
    protected $fillable = ['allowance_option'];
    public function salaries()
    {
        return $this->hasMany(Salary::class);
    }
}
