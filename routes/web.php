<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VlogController;

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
<<<<<<< HEAD

// File Upload
Route::post('/uploadManual', [UserController::class, 'uploadManual'])->name('uploadManual');

=======
Route::post('/uploadManual', [UserController::class, 'uploadManual'])->name('uploadManual');
Route::get('/updateManualData/{id}', [UserController::class, 'updateManualData']);
Route::post('/update-manual', [UserController::class, 'editManualData'])->name('uploadmanualdata.update');
Route::delete('/deleteUpload/{id}', [UserController::class, 'deleteUploaddata'])->name('upload.delete');
>>>>>>> 50393d61ea85f31bcb03fd89a0b2c9a0b294a2c8

