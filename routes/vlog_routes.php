<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VlogController;

// ✅ Vlogs Related Routes
Route::resource('vlogs', VlogController::class);
Route::post('/vlogs/{id}/like', [VlogController::class, 'like'])->name('vlogs.like');
Route::post('/vlogs/{id}/dislike', [VlogController::class, 'dislike'])->name('vlogs.dislike');

Route::post('/comments', [VlogController::class, 'addComment'])->name('comments.store');
Route::delete('/comments/{id}', [VlogController::class, 'deleteComment'])->name('comments.destroy');

