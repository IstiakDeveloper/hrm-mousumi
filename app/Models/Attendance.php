<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = ['employee_id', 'date', 'status', 'clock_in', 'clock_out', 'late_minutes', 'early_leaving_minutes', 'overtime_minutes'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
