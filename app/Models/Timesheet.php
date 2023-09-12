<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    protected $fillable = ['employee_id', 'date', 'hours_worked', 'description'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
