<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AccountsController;
use App\Http\Controllers\Backend\BannersController;
use App\Http\Controllers\Backend\RoomController;
use App\Http\Controllers\Frontend\IndexController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';




//Frontend Group Routes

Route::namespace('App\Http\Controllers\Frontend')->group(function(){

    Route::get('/',[IndexController::class, 'index']);
 });

//Backend Group Routes
Route::prefix('/hotel-de-luna')->namespace('App\Http\Controllers\Accounts')->group(function(){

    //Hotel login/logout route
    Route::match(['get','post'],'login',[AccountsController::class, 'login']);
    Route::get('logout',[AccountsController::class, 'logout']);

    //404 NOT FOUND
    Route::get('error',[AccountsController::class, 'error']);

    //Group middleware route
    Route::group(['middleware'=>['midware']],function(){
        Route::get('dashboard',[AccountsController::class, 'dashboard']);

        // Profile
        Route::get('user-profile',[AccountsController::class, 'UserProfile']);
    });
    });

    //Fetching Provinces, Cities, Brgys of PHILIPPINES
    Route::post('api/fetch-provinces', [AccountsController::class, 'fetchProvinces']);
    Route::post('api/fetch-cities', [AccountsController::class, 'fetchCities']);
    Route::post('api/fetch-barangay', [AccountsController::class, 'fetchBrgy']);


    //ACCOUNTS MANAGEMENT
    Route::prefix('/users-management')->group(function(){
    Route::group(['middleware'=>['midware']],function(){

    Route::get('accounts',[AccountsController::class, 'accounts']);

    });
});
    // USERS MANAGEMENT
    Route::prefix('/users-management')->group(function(){
        Route::group(['middleware'=>['midware']],function(){
        Route::get('employee',[AccountsController::class, 'employee']);
        Route::get('delete-employee/{id}',[AccountsController::class, 'deleteEmployee']);
        Route::post('update-employee-status',[AccountsController::class, 'updateEmployeeStatus']);
        Route::match(['get','post'],'add-edit-employee/{id?}',[AccountsController::class, 'storeEmployee']);
    });
});
    //Banners Management
    Route::prefix('/banners-management')->group(function(){
        Route::group(['middleware'=>['midware']],function(){
        Route::get('banners',[BannersController::class, 'banners']);
        Route::post('update-banner-status',[BannersController::class, 'updateBannerStatus']);
        Route::get('delete-banner/{id}',[BannersController::class, 'deleteBanners']);
       Route::match(['get','post'],'add-edit-banners/{id?}', [BannersController::class, 'AddEditBanner']);
    });
});

Route::prefix('/rooms-management')->group(function(){
    Route::group(['middleware'=>['midware']],function(){

        //Rooms
        Route::get('rooms',[RoomController::class, 'rooms']);
        Route::post('update-room-status',[RoomController::class, 'updateRoomStatus']);
        Route::get('delete-room/{id}',[RoomController::class, 'deleteRoom']);
        Route::match(['get','post'],'add-edit-rooms/{id?}', [RoomController::class, 'AddEditRoom']);

        //RoomType
        Route::get('roomtype',[RoomController::class, 'roomtype']);
        Route::match(['get','post'],'add-edit-roomtype/{id?}', [RoomController::class, 'AddEditRoomtype']);
        Route::post('update-roomtype-status',[RoomController::class, 'updateRoomtypeStatus']);
    });
});








