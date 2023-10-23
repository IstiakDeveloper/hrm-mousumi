<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['name', 'description', 'branch_id', 'department_head_id'];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function designations()
    {
        return $this->hasMany(Designation::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function departmentHead()
    {
        return $this->belongsTo(User::class, 'department_head_id');
    }
}


