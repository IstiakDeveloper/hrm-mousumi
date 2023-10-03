<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allowance extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'type', 'amount'];

    public function allowanceOption()
    {
        return $this->belongsTo(AllowanceOption::class);
    }
}
