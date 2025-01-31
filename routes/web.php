<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PermissionGroupController;
use App\Http\Controllers\RoleController;
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

// Route::prefix('HR')->middleware([Check::class])->group(function () {
//     // Role
//     Route::get('/hr', [RoleController::class, 'index'])->name('hr.index');
//     Route::post('/hr-store', [RoleController::class, 'store'])->name('hr.store');
//     Route::put('/hr-update/{role}', [RoleController::class, 'update'])->name('hr.update');
//     Route::get('/hr-delete/{role}', [RoleController::class, 'delete'])->name('hr.delete');


// });

// Auth
