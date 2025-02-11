<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
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

Route::post('Notice/Message', [UserController::class, 'messageInsert'])->name('notice.message');

//home page route
Route::get('/kavach/Index/',[HomeController::class, 'kavach_index'])->name('kavach.index');
Route::get('/kavach/Overview/',[HomeController::class, 'kavach_overview'])->name('kavach.overview');
Route::get('/kavach/Multimedia/',[HomeController::class, 'kavach_multimedia'])->name('kavach.multimedia');
Route::get('/kavach/Brochure/',[HomeController::class, 'kavach_brochure'])->name('kavach.brochure');
Route::get('/kavach/Advisories/',[HomeController::class, 'kavach_advisories'])->name('kavach.advisories');

Route::get('/lte/Index/',[HomeController::class, 'lte_index'])->name('LTE.Index');
Route::get('/lte/Overview/',[HomeController::class, 'lte_overview'])->name('lte.overview');
Route::get('/lte/Brochure/',[HomeController::class, 'lte_brochure'])->name('lte.brochure');
Route::get('/lte/Advisories/',[HomeController::class, 'lte_advisories'])->name('lte.advisories');
Route::get('/lte/Multimedia/',[HomeController::class, 'lte_multimedia'])->name('lte.multimedia');
Route::get('/organisation/Index/',[HomeController::class, 'organisation_index'])->name('organisation.index');

Route::get('/5G/Index/',[HomeController::class, '_5G_index'])->name('5G.Index');
Route::get('/5G/Overview/',[HomeController::class, '_5G_overview'])->name('5G.overview');
Route::get('/5G/Brochure/',[HomeController::class, '_5G_brochure'])->name('5G.brochure');
Route::get('/5G/advisories/',[HomeController::class, '_5G_advisories'])->name('5G.advisories');
Route::get('/5G/Multimedia/',[HomeController::class, '_5G_multimedia'])->name('5G.multimedia');


Route::get('/Download/history/{id}', [HomeController::class, 'history_data']);
Route::get('/Remark/{id}', [HomeController::class, 'remark']);
Route::post('/Remark/Add/', [HomeController::class, 'remark_add']);

// Include Vlog Routes
require __DIR__.'/vlog_routes.php';
