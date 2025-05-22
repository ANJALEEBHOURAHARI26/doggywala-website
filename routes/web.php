<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\PetController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\HomeController;
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
Route::get('/blogs', [HomeController::class, 'blogs'])->name('blogs');
Route::get('/contact-us', [HomeController::class, 'contactUs'])->name('conract-us');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search_pet', [HomeController::class, 'search'])->name('pets');
Route::post('/save_pet', [HomeController::class, 'savePet'])->name('savePet');

Route::group(['prefix' => 'admin','middleware' => 'checkRole'], function(){
    Route::get('/dashboard',[DashboardController::class,'index'])->name('admin.dashboard');
    Route::get('/users',[UserController::class,'index'])->name('admin.users');
    Route::get('/users/{id}',[UserController::class,'edit'])->name('admin.users.edit');
    Route::put('/users/{id}',[UserController::class,'update'])->name('admin.users.update');
    Route::delete('/users',[UserController::class,'destroy'])->name('admin.users.destroy');
    Route::get('/pets',[PetController::class,'index'])->name('admin.pets');
    Route::get('/pets/edit/{id}',[PetController::class,'edit'])->name('admin.pets.edit');
    Route::put('/pets/{id}',[PetController::class,'updatePet'])->name('admin.jobs.update');
    });

Route::group(['prefix' => 'account', 'controller' => AccountController::class], function () {

    // Guest Routes
    Route::group(['middleware' => 'guest'], function () {
        Route::any('/register', 'registration')->name('account.registration');
        Route::any('/process-register', 'processRegistration')->name('account.processRegistration');
        Route::any('/login', 'login')->name('account.login');
        Route::any('/authenticate', 'authenticate')->name('account.authenticate');
    });

    // Authenticated Routes
    Route::group(['middleware' => 'auth'], function () {
        Route::any('/profile', 'profile')->name('account.profile');
        Route::any('/update-profile', 'updateProfile')->name('account.updateProfile');
        Route::any('/logout', 'logout')->name('account.logout');
        Route::any('/update-profile-pic', 'updateProfilePic')->name('account.updateProfilePic');

        // Pet Management Routes
        Route::any('/create-pet', 'createPet')->name('account.createPet');
        Route::any('/store-pet', 'store')->name('account.storePet');
        Route::any('/save-pet', 'savePet')->name('account.savePet');
        Route::any('/store-pet/{pets}/edit', 'edit')->name('account.edit');
        Route::any('/store-pet/{pets}', 'update')->name('account.update');
        Route::any('/store-pet/{pets}/delete', 'destroy')->name('account.destroy');
        Route::any('/saved-pets', 'savedPets')->name('account.savedPets');
        Route::any('/remove-saved-pet/{id}', 'removeSavedPet')->name('removeSavedPet');
        Route::any('/send-feedback', 'sendFeedback')->name('sendFeedback');

        

    });
});
