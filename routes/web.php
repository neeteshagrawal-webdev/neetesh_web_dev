<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// Default login page
Route::get('/', function () {
    return view('login');
});

// User routes
Route::get('/home/index', [UserController::class, 'home'])->name('home');
Route::post('/home', [UserController::class, 'login'])->name('user.login');
Route::get('/uploads', [UserController::class, 'upload_data'])->name('uploads.show');
Route::get('/scrollMessage', [UserController::class, 'scroll_message'])->name('scroll.message');
Route::get('/users', [UserController::class, 'users_view'])->name('users.show');
Route::get('/loginActivity', [UserController::class, 'login_activity'])->name('login.activity');
Route::get('/report', [UserController::class, 'report_show'])->name('user.report');

// File Upload Routes
Route::post('/uploadManual', [UserController::class, 'uploadManual'])->name('uploadManual');
Route::get('/updateManualData/{id}', [UserController::class, 'updateManualData']);
Route::post('/update-manual', [UserController::class, 'editManualData'])->name('uploadmanualdata.update');
Route::delete('/deleteUpload/{id}', [UserController::class, 'deleteUploaddata'])->name('upload.delete');

// User Management Routes
Route::post('user/create', [UserController::class, 'userInsert'])->name('user.create');
Route::get('/updateUserData/{id}', [UserController::class, 'updateUserData']);
Route::post('/update/user', [UserController::class, 'editUserData'])->name('editUserdata.update');
Route::delete('/deleteUser/{id}', [UserController::class, 'deleteUserddata'])->name('user.delete');

// Include Vlog Routes
require __DIR__.'/vlog_routes.php';
