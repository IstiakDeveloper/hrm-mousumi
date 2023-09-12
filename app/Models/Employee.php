<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Employee extends Authenticatable
{
    use HasRoles;

    protected $fillable = [
        'name', 'phone', 'date_of_birth', 'gender', 'email', 'password', 'address',
        'employee_id', 'branch_id', 'department_id', 'designation_id', 'date_of_joining',
        'certificate', 'resume', 'photo', 'account_holder_name', 'account_number',
        'bank_name', 'branch_location', 'swift_code',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function bankAccount()
    {
        return $this->hasOne(BankAccount::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }

    public function salaries()
    {
        return $this->hasMany(Salary::class);
    }

    public function timesheets()
    {
        return $this->hasMany(Timesheet::class);
    }
}

