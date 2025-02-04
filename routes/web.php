<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PermissionGroupController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Check;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });

// Main

Route::get('/', [MainController::class, 'index'])->name('main')->middleware([Check::class]);


Route::group(['prefix' => 'auth'], function () {

    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});



Route::prefix('admin')->middleware([Check::class])->group(function () {
    // Role
    Route::get('/role', [RoleController::class, 'index'])->name('role.index');
    Route::post('/role-store', [RoleController::class, 'store'])->name('role.store');
    Route::put('/role-update/{role}', [RoleController::class, 'update'])->name('role.update');
    Route::get('/role-delete/{role}', [RoleController::class, 'delete'])->name('role.delete');
    Route::get('/role-status/{role}', [RoleController::class, 'status'])->name('role.status');

    // Permission
    Route::post('/permission-store/{role}', [PermissionController::class, 'givePermission'])->name('permission.store');
    Route::get('/permission-index/{role}', [PermissionController::class, 'index'])->name('permission.index');
    Route::post('/permission-status/{group}', [PermissionController::class, 'status'])->name('permission.status');

    // Permission-group
    Route::get('/permission-group-index', [PermissionGroupController::class, 'index'])->name('permission-group.index');
    Route::get('/permission-group-status/{group}', [PermissionGroupController::class, 'status'])->name('permission-group.status');


    // User
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::post('/user-store', [UserController::class, 'store'])->name('user.store');
    Route::put('/user-update/{user}', [UserController::class, 'update'])->name('user.update');
    Route::get('/user-delete/{user}', [UserController::class, 'delete'])->name('user.delete');
    Route::get('/user-status/{user}', [UserController::class, 'status'])->name('user.status');
});

Route::prefix('HR')->middleware([Check::class])->group(function () {
    // Department
    Route::get('/department', [DepartmentController::class, 'index'])->name('department.index');
    Route::post('/department-store', [DepartmentController::class, 'store'])->name('department.store');
    Route::put('/department-update/{department}', [DepartmentController::class, 'update'])->name('department.update');
    Route::get('/department-delete/{department}', [DepartmentController::class, 'delete'])->name('department.delete');

    // Salary
    Route::get('/salary', [SalaryController::class, 'index'])->name('salary.index');
    Route::post('/salary-store', [SalaryController::class, 'store'])->name('salary.store');
    Route::put('/salary-update/{salary}', [SalaryController::class, 'update'])->name('salary.update');
    Route::get('/salary-delete/{salary}', [SalaryController::class, 'delete'])->name('salary.delete');

    // Employee
    Route::get('/employee', [EmployeeController::class, 'index'])->name('employee.index');
    Route::post('/employee-store', [EmployeeController::class, 'store'])->name('employee.store');
    Route::put('/employee-update/{employee}', [EmployeeController::class, 'update'])->name('employee.update');
    Route::get('/employee-delete/{employee}', [EmployeeController::class, 'delete'])->name('employee.delete');
    Route::get('/employee-status/{employee}', [EmployeeController::class, 'status'])->name('employee.status');


});


