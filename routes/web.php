<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/posts/trashedposts', [PostController::class, 'trashedpostes'])->name('posts.trashed');
Route:: middleware('auth')->resource('posts', PostController::class);
Route::patch('/posts/restore/{id}', [PostController::class, 'restore'])->name('posts.restore');
Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::delete('/posts/force-delete/{id}', [PostController::class, 'forcedelete'])->name('posts.forcedelete');
// Route::get('/posts/tag/{slug}', [PostController::class, 'filterByTag'])->name('posts.byTag');

require __DIR__.'/auth.php';
