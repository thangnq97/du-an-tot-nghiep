<?php

use App\Http\Controllers\admin\InteriorsController as AdminInteriorsController;
use App\Http\Controllers\admin\RoomController;
use App\Http\Controllers\admin\ServiceController;
use App\Http\Controllers\admin\InteriorsController;
use App\Http\Controllers\admin\RoominteriorController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\Roominterior as ControllersRoominterior;
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
Route::get('view', function (){
    return view("layouts.admin.layout");
});
Route::resource('room' , RoomController::class);
Route::resource('service' , ServiceController::class);
Route::get('createpeople', [RoomController::class , 'createPeople'])->name('room.createpeople');

//  interiors

Route::resource('interiors',InteriorsController::class);

Route::resource('users',UsersController::class);
Route::resource('Roominterior', RoominteriorController::class);
