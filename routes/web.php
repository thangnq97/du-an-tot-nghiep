<?php

use App\Http\Controllers\admin\WaterController;
use App\Http\Controllers\admin\BillController;
use App\Models\Bill;
use App\Models\Water_usage;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('view', function (){
    return view("layouts.layoutAdmin");
});
Route::resource('waters', WaterController::class);

Route::get('/bill', [BillController::class,'index'])->name('bill.index');
Route::post('/bill/store', [BillController::class,'store'])->name('bill.store');
Route::get('/bill/create', [BillController::class,'create'])->name('bill.create');
Route::post('/bill/demoShow', [BillController::class,'demoShow'])->name('bill.demoShow');

