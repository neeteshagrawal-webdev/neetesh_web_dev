<?php
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VlogController;

Route::get('/', function () {
    return view('login');
});
Route::get('/home/index', [UserController::class, 'home'])->name('home');
Route::post('/home', [UserController::class, 'login'])->name('user.login');
Route::get('/uploads', [UserController::class, 'upload_data'])->name('uploads.show');
Route::get('/scrollMessage', [UserController::class, 'scroll_message'])->name('scroll.message');
Route::get('/users', [UserController::class, 'users_view'])->name('users.show');
Route::get('/loginActivity', [UserController::class, 'login_activity'])->name('login.activity');
Route::get('/report', [UserController::class, 'report_show'])->name('user.report');
<<<<<<< HEAD
Route::post('/uploadManual',  [UserController::class, 'uploadManual'])->name('uploadManual');

Route::resource('vlogs', VlogController::class);
Route::post('/vlogs/{id}/like', [VlogController::class, 'like'])->name('vlogs.like');
Route::post('/vlogs/{id}/dislike', [VlogController::class, 'dislike'])->name('vlogs.dislike');
=======
Route::post('/uploadManual', [UserController::class, 'uploadManual'])->name('uploadManual');
Route::get('/updateManualData/{id}', [UserController::class, 'updateManualData']);
Route::post('/update-manual', [UserController::class, 'editManualData'])->name('uploadmanualdata.update');
Route::delete('/deleteUpload/{id}', [UserController::class, 'deleteUploaddata'])->name('upload.delete');
>>>>>>> 50393d61ea85f31bcb03fd89a0b2c9a0b294a2c8

