<?php


use App\Http\Controllers\admin\AdminHomeController;
use App\Http\Controllers\admin\ContractController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\RoomController;
use App\Http\Controllers\admin\ServiceController;
use App\Http\Controllers\admin\WaterController;
use App\Http\Controllers\admin\BillController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\admin\ElectricController;
use App\Http\Controllers\user\BillUserController;
use App\Models\Bill;
use Illuminate\Routing\ViewController;
use App\Http\Controllers\admin\InteriorsController;
use App\Http\Controllers\admin\RoominteriorController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\admin\user_informationController;
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
Route::get('/sign-out', [AdminHomeController::class, 'signOut'])->name('admin.signout');
Route::post('/register', [AdminHomeController::class, 'postRegister']);
Route::get('/active/{admin}/{token}', [AdminHomeController::class, 'active'])->name('admin.active');
Route::middleware('auth')->group(function() {
    Route::get('/payment/{bill}', [BillUserController::class, 'payment'])->name('user.payment');
    Route::get('/', [BillUserController::class, 'index'])->name('user.index');
    Route::get('/handle', [BillUserController::class, 'handle'])->name('user.handlePayment');
});

Route::prefix('room/')->group(function () {
    // Hoi
    Route::get('/', [RoomController::class, 'index'])->name('room.index');
    Route::get('create', [RoomController::class, 'create'])->name('room.create');
    Route::get('{room}/show_service', [RoomController::class, 'show_service'])->name('room.show_service');
    Route::get('{room}/show_user', [RoomController::class, 'show_user'])->name('room.show_user');
    Route::get('{room}/show_interior', [RoomController::class, 'show_interior'])->name('room.show_interior');
    Route::get('{room}/create_service', [RoomController::class, 'create_service'])->name('room.create_service');
    Route::post('{room}/store_service', [RoomController::class, 'store_service'])->name('room.store_service');
    Route::get('{room}/create_people', [RoomController::class, 'create_People'])->name('room.create_people');
    Route::post('{room}/store_people', [RoomController::class, 'store_People'])->name('room.store_people');
    Route::post('store', [RoomController::class, 'store'])->name('room.store');
    Route::get('{room}/edit', [RoomController::class, 'edit'])->name('room.edit');
    Route::put('{room}', [RoomController::class, 'update'])->name('room.update');
    Route::delete('{room}', [RoomController::class, 'destroy'])->name('room.destroy');

    // Thang
    Route::get('/{room}/member', [UserController::class, 'index'])->name('admin.member.index');
    Route::get('/{room}/create_member', [UserController::class, 'create'])->name('admin.member.create');
    Route::post('/{room}/store_member', [UserController::class, 'store'])->name('admin.member.store');
    Route::get('/{room}/{id}/edit_member', [UserController::class, 'edit'])->name('admin.member.edit');
    Route::put('/{room}/{id}/update_member', [UserController::class, 'update'])->name('admin.member.update');
    Route::delete('/{room}/{id}/delete_member', [UserController::class, 'destroy'])->name('admin.member.destroy');
    Route::get('/{room}/contract', [ContractController::class, 'index'])->name('admin.room.contract');
    Route::post('/{room}/contract', [ContractController::class, 'store'])->name('admin.contract.store');
    Route::get('/{room}/extension', [ContractController::class, 'createExtensionContract'])->name('admin.create.extension.contract');
    Route::get('/{room}/{contract}', [ContractController::class, 'viewContract'])->name('admin.contract.view');
    Route::post('/{room}/contract/extension', [ContractController::class, 'extension'])->name('admin.extension.contract.store');
    Route::get('/{room}/extension/{extension_contract}', [ContractController::class, 'viewExtensionContract'])->name('admin.extension.contract.view');
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
Route::delete('/bill/{id}/delete', [BillController::class, 'destroy'])->name('bill.destroy');
Route::get('/bill/search', [BillController::class,'search'])->name('bill.search');
Route::prefix('admin/')->middleware('admin')->group(function() {
    Route::prefix('room/')->group(function () {
        // Hoi
        Route::get('/', [RoomController::class, 'index'])->name('room.index');
        Route::get('create', [RoomController::class, 'create'])->name('room.create');
        Route::get('{room}/show_service', [RoomController::class, 'show_service'])->name('room.show_service');
        Route::get('{room}/show_user', [RoomController::class, 'show_user'])->name('room.show_user');
        Route::get('{room}/show_interior', [RoomController::class, 'show_interior'])->name('room.show_interior');
        Route::get('{room}/create_service', [RoomController::class, 'create_service'])->name('room.create_service');
        Route::post('{room}/store_service', [RoomController::class, 'store_service'])->name('room.store_service');
        Route::get('{room}/create_people', [RoomController::class, 'create_People'])->name('room.create_people');
        Route::post('{room}/store_people', [RoomController::class, 'store_People'])->name('room.store_people');
        Route::post('store', [RoomController::class, 'store'])->name('room.store');
        Route::get('{room}/edit', [RoomController::class, 'edit'])->name('room.edit');
        Route::put('{room}', [RoomController::class, 'update'])->name('room.update');
        Route::delete('{room}', [RoomController::class, 'destroy'])->name('room.destroy');
    
        // Thang
        Route::get('/{room}/member', [UserController::class, 'index'])->name('admin.member.index');
        Route::get('/{room}/create_member', [UserController::class, 'create'])->name('admin.member.create');
        Route::post('/{room}/store_member', [UserController::class, 'store'])->name('admin.member.store');
        Route::get('/{room}/{id}/edit_member', [UserController::class, 'edit'])->name('admin.member.edit');
        Route::put('/{room}/{id}/update_member', [UserController::class, 'update'])->name('admin.member.update');
        Route::delete('/{room}/{id}/delete_member', [UserController::class, 'destroy'])->name('admin.member.destroy');
        Route::get('/{room}/contract', [ContractController::class, 'index'])->name('admin.room.contract');
        Route::post('/{room}/contract', [ContractController::class, 'store'])->name('admin.contract.store');
        Route::get('/{room}/extension', [ContractController::class, 'createExtensionContract'])->name('admin.create.extension.contract');
        Route::get('/{room}/{contract}', [ContractController::class, 'viewContract'])->name('admin.contract.view');
        Route::post('/{room}/contract/extension', [ContractController::class, 'extension'])->name('admin.extension.contract.store');
        Route::get('/{room}/extension/{extension_contract}', [ContractController::class, 'viewExtensionContract'])->name('admin.extension.contract.view');
    });
    //Thang
    Route::get('/', [AdminHomeController::class, 'index'])->name('admin.index');

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
    Route::delete('/bill/{id}/delete', [BillController::class, 'destroy'])->name('bill.destroy');
    Route::get('/bill/search', [BillController::class,'search'])->name('bill.search');

    //DUNG
    // Route::get('/electric', [ElectricController::class,'index']);
    Route::resource('/electric', ElectricController::class);
    Route::resource('/user_bill', BillUserController::class);
    // Route::get('user_bill/{id}/bill_user', [BillUserController::class, 'index'])->name('user.index');
});

//DUNG
// Route::get('/electric', [ElectricController::class,'index']);
Route::resource('/electric', ElectricController::class);
Route::resource('/user_bill', BillUserController::class);
Route::get('/bill/{id}/generate-pdf', [BillUserController::class, 'generatePDF'])->name('bill.generatePDF');
// Route::get('user_bill/{id}/bill_user', [BillUserController::class, 'index'])->name('user.index');



Route::get('view', function (){
    return view("layouts.admin.layout");
});

Route::resource('room' , RoomController::class);
Route::resource('service' , ServiceController::class);
Route::get('createpeople', [RoomController::class , 'createPeople'])->name('room.createpeople');


//tùng
//  interiors
Route::resource('interiors',InteriorsController::class);
//  Roominterior
Route::resource('Roominterior', RoominteriorController::class);
//user_information
Route::resource('user_information', user_informationController::class);
