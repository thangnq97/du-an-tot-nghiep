<?php

use App\Http\Controllers\admin\RoomController;
use App\Http\Controllers\admin\ServiceController;
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
