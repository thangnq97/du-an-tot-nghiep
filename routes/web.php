<?php

use App\Http\Controllers\admin\RoomController;
use App\Http\Controllers\admin\ServiceController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('view', function () {
    return view("layouts.admin.layout");
});
// Route::resource('room' , RoomController::class);
Route::prefix('room/')->group(function () {
    Route::get('/', [RoomController::class, 'index'])->name('room.index');
    Route::get('create', [RoomController::class, 'create'])->name('room.create');
    Route::get('{room}/show_service', [RoomController::class, 'show_service'])->name('room.show_service');
    Route::get('{room}/show_user', [RoomController::class, 'show_user'])->name('room.show_user');
    Route::get('{room}/show_interior', [RoomController::class, 'show_interior'])->name('room.show_interior');
    Route::get('{room}/create_service', [RoomController::class, 'create_service'])->name('room.create_service');
    Route::post('{room}/store_service', [RoomController::class, 'store_service'])->name('room.store_service');
    Route::get('createpeople', [RoomController::class, 'createPeople'])->name('room.createpeople');
    Route::post('store', [RoomController::class, 'store'])->name('room.store');
    Route::get('{room}/edit', [RoomController::class, 'edit'])->name('room.edit');
    Route::put('{room}', [RoomController::class, 'update'])->name('room.update');
    Route::delete('{room}', [RoomController::class, 'destroy'])->name('room.destroy');
});
Route::delete('room_service/{room}/', [RoomController::class, 'delete_service'])->name('room.delete_service');      
Route::resource('service', ServiceController::class);
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
