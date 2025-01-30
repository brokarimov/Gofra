<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Check;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });

// Main
Route::get('/', [MainController::class, 'index'])->name('main')->middleware([Check::class]);
Route::prefix('admin')->middleware([Check::class])->group(function () {
    // Role
    Route::get('/role', [RoleController::class, 'index'])->name('role.index');
    Route::post('/role-store', [RoleController::class, 'store'])->name('role.store');
    Route::put('/role-update/{role}', [RoleController::class, 'update'])->name('role.update');
    Route::get('/role-delete/{role}', [RoleController::class, 'delete'])->name('role.delete');

    // Permission
    Route::post('/permission-store/{role}', [PermissionController::class, 'givePermission'])->name('permission.store');

    // User
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::post('/user-store', [UserController::class, 'store'])->name('user.store');
    Route::put('/user-update/{user}', [UserController::class, 'update'])->name('user.update');
    Route::get('/user-delete/{user}', [UserController::class, 'delete'])->name('user.delete');
});


// Auth
Route::get('/login', [AuthController::class, 'index'])->name('login');  
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);
