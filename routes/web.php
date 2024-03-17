<?php

use App\Http\Controllers\admin\AdminHomeController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\RoomController;
use App\Http\Controllers\admin\ServiceController;
use App\Http\Controllers\admin\WaterController;
use App\Http\Controllers\admin\BillController;
use App\Http\Controllers\PDFController;
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
//Thang
Route::get('/login', [AdminHomeController::class, 'login'])->name('admin.login');
Route::post('/login', [AdminHomeController::class, 'saveLogin']);
Route::get('/register', [AdminHomeController::class, 'register'])->name('admin.register');
Route::post('/register', [AdminHomeController::class, 'postRegister']);
Route::get('/active/{admin}/{token}', [AdminHomeController::class, 'active'])->name('admin.active');

Route::prefix('room/')->group(function () {
    // Hoi
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

    // Thang
    Route::get('/{room}', [UserController::class, 'index'])->name('admin.member.index');
    Route::get('/{room}/create', [UserController::class, 'create'])->name('admin.member.create');
    Route::post('/{room}/store', [UserController::class, 'store'])->name('admin.member.store');
    Route::get('/{room}/{id}/edit', [UserController::class, 'edit'])->name('admin.member.edit');
    Route::put('/{room}/{id}/update', [UserController::class, 'update'])->name('admin.member.update');
    Route::delete('/{room}/{id}/delete', [UserController::class, 'destroy'])->name('admin.member.destroy');
});
//Hoi
Route::delete('room_service/{room}/', [RoomController::class, 'delete_service'])->name('room.delete_service');      
Route::resource('service', ServiceController::class);
//Dinh
Route::resource('waters', WaterController::class);
Route::get('/bill', [BillController::class,'index'])->name('bill.index');
Route::post('/bill/demoShow', [BillController::class,'store'])->name('bill.store');
Route::get('/bill/{id}/bill_detail', [BillController::class,'show'])->name('bill.show');
Route::get('/bill/{id}/generate-pdf', [BillController::class, 'generatePDF'])->name('bill.generatePDF');
Route::get('/bill/{id}/edit', [BillController::class, 'edit'])->name('bill.edit');
Route::put('/bill/{id}/update', [BillController::class, 'update'])->name('bill.update');

