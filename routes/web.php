<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\LeaveTypeController;
use App\Http\Controllers\Payroll\AllowanceOptionController;
use App\Http\Controllers\Payroll\DeductionOptionController;
use App\Http\Controllers\Payroll\LoanOptionController;
use App\Http\Controllers\Payroll\PayslipTypeController;
use App\Http\Controllers\TimesheetController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('create-superadmin', [AdminController::class, 'createSuperAdmin']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('branches', BranchController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('designations', DesignationController::class);
    Route::resource('employees', EmployeeController::class);
    Route::get('employees/{employee}/print', [EmployeeController::class, 'print'])->name('employees.print');
    Route::get('employees/{employee}/download',  [EmployeeController::class, 'download'])->name('employees.download');

    Route::controller(RoleController::class)->group(function(){
        Route::get('all/permission', 'AllPermission')->name('all.permission');
        Route::get('create/permission/create', 'CreatePermission')->name('permission.create');
        Route::post('store/permission/store', 'StorePermission')->name('permission.store');
        Route::get('edit/permission/{id}', 'EditPermission')->name('permission.edit');
        Route::post('update/permission', 'UpdatePermission')->name('permission.update');
        Route::delete('delete/permission/{id}', 'DestroyPermission')->name('permission.destroy');

        Route::get('import/permission', 'ImportPermission')->name('permission.import');
        Route::get('permission/export', 'Export')->name('permission.export');
        Route::post('permission/import', 'Import')->name('import');
    });

    Route::controller(RoleController::class)->group(function(){
        Route::get('all/roles', 'AllRoles')->name('role.all');
        Route::get('role/create', 'CreateRole')->name('role.create');
        Route::post('role/store', 'StoreRole')->name('role.store');
        Route::get('edit/role/{id}', 'EditRole')->name('role.edit');
        Route::post('update/role', 'UpdateRole')->name('role.update');
        Route::delete('delete/role/{id}', 'DestroyRole')->name('role.destroy');

        Route::get('add/roles/permission', 'AddRolesPermission')->name('add.roles.permission');
        Route::post('roles/permission/store', 'StoreRolesPermission')->name('roles.permission.store');
        Route::get('all/roles/permission', 'AllRolesPermission')->name('roles.permission.all');

        Route::get('admin/edit/role/{id}', 'AdminEditRoles')->name('admin.role.edit');
        Route::post('admin/role/update/{id}', 'AdminUpdateRoles')->name('admin.roles.update');
        Route::delete('admin/role/delete/{id}', 'AdminDeleteRoles')->name('admin.role.destroy');


    });

    Route::controller(AdminController::class)->group(function(){
        Route::get('all/users', 'AllUsers')->name('all.users');
        Route::get('add/user/create', 'CreateUser')->name('user.create');
        Route::post('admin/users',  'store')->name('admin.users.store');
    });
    Route::resource('timesheets', TimesheetController::class);
    Route::resource('leave_types', LeaveTypeController::class);
    Route::resource('leave', LeaveController::class);
    Route::resource('attendances', AttendanceController::class);
    Route::resource('allowance_options', AllowanceOptionController::class);
    Route::resource('deduction_options', DeductionOptionController::class);
    Route::resource('loan_options', LoanOptionController::class);
    Route::resource('payslip_types', PayslipTypeController::class);

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');




});

require __DIR__.'/auth.php';

