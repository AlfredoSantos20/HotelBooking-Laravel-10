<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AccountsController;
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

//Admin Group Route
Route::prefix('/hotel-de-luna')->namespace('App\Http\Controllers\Accounts')->group(function(){

    //Hotel login/logout route
    Route::match(['get','post'],'login',[AccountsController::class, 'login']);
    Route::get('logout',[AccountsController::class, 'logout']);

    //404 NOT FOUND
    Route::get('error',[AccountsController::class, 'error']);

    //Group middleware route
    Route::group(['middleware'=>['midware']],function(){
        Route::get('dashboard',[AccountsController::class, 'dashboard']);

        //Admin Profile
        Route::get('user-profile',[AccountsController::class, 'UserProfile']);
    });
    });

    //Fetching Provinces, Cities, Brgys of PHILIPPINES
    Route::post('api/fetch-provinces', [AccountsController::class, 'fetchProvinces']);
    Route::post('api/fetch-cities', [AccountsController::class, 'fetchCities']);
    Route::post('api/fetch-barangay', [AccountsController::class, 'fetchBrgy']);

    // USERS MANAGEMENT
    Route::prefix('/users-management')->group(function(){

        Route::get('employee',[AccountsController::class, 'employee']);
        Route::match(['get','post'],'add-edit-employee/{id?}',[AccountsController::class, 'storeEmployee'])->name('add-employee');

        Route::get('add-employee',[AccountsController::class, 'addEmployee']);
    });







