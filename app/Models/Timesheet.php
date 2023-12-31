<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    use HasFactory;
    protected $fillable = ['employee_id', 'date', 'office_start', 'office_end', 'hours_worked', 'remark'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
