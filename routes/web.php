<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
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


Route::controller(HomeController::class)->group(function () {

    Route::get('/', 'Home')->name('/');

    Route::get('/job_details/{id}', 'Job_details')->name('job_details');

});

// Here are the Auth Routes
Route::controller(AuthController::class)->group(function () {

    Route::get('/login', 'Login')->name('login');

    Route::get('/register', 'Register')->name('register');

    Route::Post('/registerUser', 'RegisterUser')->name('registerUser');

    Route::Post('/loginUser', 'LoginUser')->name('loginUser');

    Route::get('/logoutUser', 'LogoutUser')->name('logoutUser');
});

// Here are the Home Routes


// Here are the Home Routes That Must be logged in b4 Access (using auth middleware)
Route::middleware([ 'auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

    Route::controller(HomeController::class)->group(function () {

        Route::get('profile', 'Profile')->name('profile');

        Route::get('/create_job/{id}', 'Create_job')->name('create_job');

        Route::post('/add_job', 'Add_job')->name('add_job');

        Route::get('/delete_job/{id}', 'Delete_job')->name('delete_job');

        Route::get('/edit_job/{id}', 'Edit_job')->name('edit_job');

        Route::post('/update_job/{id}', 'Update_job')->name('update_job');

        Route::post('/apply_job/{id}', 'Apply_job')->name('apply_job');

        Route::get('/save_job/{id}', 'Save_job')->name('save_job');

        Route::get('/unsave_job/{id}', 'Unsave_job')->name('unsave_job');


    });

    Route::controller(AuthController::class)->group(function () {

        Route::get('user_settings/{id}', 'User_settings')->name('user_settings');

        Route::post('user_update', 'User_update')->name('user_update');


    });


    Route::controller(AdminController::class)->group(function () {

        Route::get('admin_dashboard', 'Admin_dashboard')->name('admin_dashboard');

        Route::get('create_category', 'Create_category')->name('create_category');

        Route::post('add_category', 'Add_category')->name('add_category');

        Route::get('all_category', 'All_category')->name('all_category');

        Route::get('/edit_category/{id}', 'Edit_category')->name('edit_category');

        Route::get('/delete_category/{id}', 'Delete_category')->name('delete_category');

        Route::post('/update_category/{id}', 'Update_category')->name('update_category');


    });
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
