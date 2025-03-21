<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VlogController;

// ✅ Vlogs Related Routes
Route::middleware(['auth'])->group(function () {
Route::resource('vlogs', VlogController::class);
Route::post('/vlogs/{id}/like', [VlogController::class, 'like'])->name('vlogs.like');
Route::post('/vlogs/{id}/dislike', [VlogController::class, 'dislike'])->name('vlogs.dislike');
Route::post('/comments', [VlogController::class, 'addComment'])->name('comments.store');
Route::delete('/comments/{id}', [VlogController::class, 'deleteComment'])->name('comments.destroy');
Route::post('/vlogs/toggle-status/{id}', [VlogController::class, 'toggleStatus'])->name('vlogs.toggleStatus');

Route::get('/admin/VlogShow', [VlogController::class, 'blogShow'])->name('blog.show');
Route::get('/changeblogStatus/{id}', [VlogController::class, 'change_blog_status']);


});
