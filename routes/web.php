<?php

use App\Http\Controllers\admin\AdminHomeController;
use App\Http\Controllers\admin\UserController;
use Illuminate\Routing\ViewController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [AdminHomeController::class, 'index'])->name('admin.index');
Route::get('/login', [AdminHomeController::class, 'login'])->name('admin.login');
Route::post('/login', [AdminHomeController::class, 'saveLogin']);
Route::get('/register', [AdminHomeController::class, 'register'])->name('admin.register');
Route::post('/register', [AdminHomeController::class, 'postRegister']);
Route::get('/active/{admin}/{token}', [AdminHomeController::class, 'active'])->name('admin.active');
Route::get('/room/{room}', [UserController::class, 'index'])->name('admin.member.index');
Route::get('/room/{room}/create', [UserController::class, 'create'])->name('admin.member.create');
Route::post('/room/{room}/store', [UserController::class, 'store'])->name('admin.member.store');
Route::get('/room/{room}/{id}/edit', [UserController::class, 'edit'])->name('admin.member.edit');
Route::put('/room/{room}/{id}/update', [UserController::class, 'update'])->name('admin.member.update');
Route::delete('/room/{room}/{id}/delete', [UserController::class, 'destroy'])->name('admin.member.destroy');
