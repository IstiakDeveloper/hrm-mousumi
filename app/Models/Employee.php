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

    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    /**
     * Update the yearly leave balance for the employee.
     *
     * @param int $leaveTypeId
     * @param int $days
     * @return void
     */
    public function updateYearlyLeaveBalance($leaveTypeId, $days)
    {
        // Fetch the leave type
        $leaveType = LeaveType::findOrFail($leaveTypeId);

        // Update the yearly leave balance for the specified leave type
        if ($leaveType->classification === 'Year') {
            $this->yearly_leave_balance -= $days;
            $this->save();
        }
    }


    public function getAvailableLeaveDays()
    {
        $leaveTypes = LeaveType::all(); // Get all leave types

        // Calculate total leave taken for each leave type
        $leaveTakenByType = [];
        foreach ($leaveTypes as $leaveType) {
            $totalLeaveTaken = $this->leaves()
                ->where('leave_type_id', $leaveType->id)
                ->where('status', 'Approved') // Filter only approved leaves
                ->sum('total_days');
            $leaveTakenByType[$leaveType->leave_type] = $totalLeaveTaken;
        }

        // Calculate available leave days for each leave type
        $availableLeaveDaysByType = [];
        foreach ($leaveTypes as $leaveType) {
            $dayLimit = $leaveType->day;
            $leaveTaken = $leaveTakenByType[$leaveType->leave_type];
            $availableLeaveDaysByType[$leaveType->leave_type] = max($dayLimit - $leaveTaken, 0);
        }

        return $availableLeaveDaysByType;
    }

    public function timesheetForDate($date)
    {
        // Assuming you have a Timesheet model and the employee has many timesheets
        return $this->timesheets()->where('date', $date)->first();
    }

    public function timesheets()
    {
        return $this->hasMany(Timesheet::class);
    }
    public function salaries()
    {
        return $this->hasMany(Salary::class);
    }
    public function payslips()
    {
        return $this->hasMany(Payslip::class);
    }
    public function allowances()
    {
        return $this->hasMany(Allowance::class);
    }
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
    public function deductions()
    {
        return $this->hasMany(Deduction::class);
    }

    public function payslip()
    {
        return $this->hasMany(PayslipGenarate::class);
    }
    public function loanns()
    {
        return $this->hasMany(Loann::class);
    }
    public function employeeSalary()
    {
        return $this->hasOne(EmployeeSalary::class);
    }

}

