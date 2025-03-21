<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginActivityController;
use App\Http\Controllers\OverviewController;
// Default login page
/*Route::get('/', function () {
    return view('login');

});*/
Route::post('/home', [UserController::class, 'login'])->name('user.login');
Route::get('/', function () {
    return view('login'); // Create a login page manually
})->name('login');
Route::get('/signup', [UserController::class, 'signup'])->name('user.signup');
Route::post('/signupInsert', [UserController::class, 'signupInsert'])->name('user.register');
Route::get('/getSubgroup', [UserController::class, 'get_subgroups'])->name('get.subgroups');

Route::get('/getUserSubgroup', [UserController::class, 'get_subgroup_upload'])->name('get.subgroupsupload');
Route::get('/PasswordReset', [UserController::class, 'password_reset'])->name('password.reset');
Route::post('/passwordUpdate', [UserController::class, 'password_update'])->name('password.update');

// User routes
Route::middleware(['auth'])->group(function () {
Route::get('/home/index', [UserController::class, 'home'])->name('home');

Route::get('/dataUpload', [UserController::class, 'upload_data'])->name('upload.show');
Route::get('/scrollMessage', [UserController::class, 'scroll_message'])->name('scroll.message');
Route::get('/users', [UserController::class, 'users_view'])->name('users.show');
Route::get('/user-group', [UserController::class, 'users_group'])->name('usergroups.show');
Route::get('/user-subgroup', [UserController::class, 'users_subgroup'])->name('usersubgroups.show');
Route::get('/profile-show', [HomeController::class, 'profile'])->name('profile.show'); // GET route

Route::get('/loginActivity', [UserController::class, 'login_activity'])->name('login.activity');
Route::get('/login-activity', [LoginActivityController::class, 'index'])->name('login.activity');
Route::get('/search-users', [LoginActivityController::class, 'search'])->name('users.search');

Route::get('/report', [UserController::class, 'report_show'])->name('user.report');

Route::get('/overview', [OverviewController::class, 'index'])->name('overview.index');
Route::get('/overview/create', [OverviewController::class, 'create'])->name('overview.create');
Route::post('/overview/store', [OverviewController::class, 'store'])->name('overview.store');
Route::delete('/overview/{id}', [OverviewController::class, 'destroy'])->name('overview.destroy');
// File Upload Routes
Route::post('/uploadManual', [UserController::class, 'uploadManual'])->name('uploadManual');
Route::get('/updateManualData/{id}', [UserController::class, 'updateManualData']);
Route::post('/update-manual', [UserController::class, 'editManualData'])->name('uploadmanualdata.update');
Route::delete('/deleteUpload/{id}', [UserController::class, 'deleteUploaddata'])->name('upload.delete');
Route::post('usergroup/create', [UserController::class, 'usergroupInsert'])->name('user_group.create');
Route::post('usersubgroup/create', [UserController::class, 'usersubgroupInsert'])->name('user_sub_group.create');
// User Management Routes
Route::post('user/create', [UserController::class, 'userInsert'])->name('user.create');
Route::get('/updateUserData/{id}', [UserController::class, 'updateUserData']);
Route::get('/updateUserGroupData/{id}', [UserController::class, 'updateUserGroupData']);
Route::get('/updateUsersubGroupData/{id}', [UserController::class, 'updateUserSubGroupData']);

Route::post('/update/usergroup', [UserController::class, 'editUsergroupData'])->name('editUsergroupdata.update');
Route::post('/update/usersubgroup', [UserController::class, 'editUserSubgroupData'])->name('editUsersubgroupdata.update');

Route::post('/update/user', [UserController::class, 'editUserData'])->name('editUserdata.update');
Route::delete('/deleteUser/{id}', [UserController::class, 'deleteUserddata'])->name('user.delete');
Route::delete('/deleteUserGroup/{id}', [UserController::class, 'deleteUserGroup'])->name('usergroup.delete');

Route::get('/acceptUser/{id}', [UserController::class, 'acceptUser']);
Route::post('/give/permissions', [UserController::class, 'save_permission']);


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
Route::get('/Report/Search/',[HomeController::class, 'search_data'])->name('records.search');
Route::get('/KMS/Timeline/{id}', [HomeController::class, 'timeline']);


Route::post('/profileImage/update', [HomeController::class, 'updateProfileimage'])->name('profileImage.update');
Route::post('/ChangePassword', [HomeController::class, 'change_password'])->name('changepassword.update'); // POST route

/*Route::get('/forgotPassword', [UserController::class, 'forgot_password'])->name('user.forgot_password');
*/
Route::get('forgot-password', [UserController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('forgotPassword', [UserController::class, 'sendResetLink'])->name('password.email');
Route::get('reset-password/{token}', [UserController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('reset-password', [UserController::class, 'resetPassword'])->name('password.update');
Route::get('logout', [HomeController::class, 'logout'])->name('logout');
// Include Vlog Routes
require __DIR__.'/vlog_routes.php';
});