<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\PostsController;
use App\Http\Controllers\Dashboard\TagsController;
use App\Http\Controllers\Dashboard\UsersController;
use App\Http\Controllers\Frontend\CategoryPostController;
use App\Http\Controllers\Frontend\HomeController as FrontendHomeController;
use App\Http\Controllers\Frontend\MyPostController;
use App\Http\Controllers\Frontend\PostDetailsController;
use App\Http\Controllers\Frontend\TagsPostController;
use App\Http\Controllers\Frontend\WriteController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\User;
use Illuminate\Support\Facades\Route;

/**
 * frontend routes
 */
Route::name('frontend.')->group(function () {

    Route::controller(FrontendHomeController::class)->group(function () {
        Route::get('/', 'index')->name('home');
    });

    Route::controller(PostDetailsController::class)->group(function () {
        Route::get('/blog/post/{id}/{slug}', 'show')->name('blog-post');
    });

    Route::controller(CategoryPostController::class)->group(function () {
        Route::get('/blog/category/post/{id}', 'show')->name('blog-category-post');
    });

    Route::controller(TagsPostController::class)->group(function () {
        Route::get('/blog/tag/post/{id}', 'show')->name('blog-tag-post');
    });

    // authenticated routes
    Route::middleware(['auth', 'verified', User::class])->group(function () {
        // write controller
        Route::controller(WriteController::class)->group(function () {
            Route::get('/blog/post/write', 'index')->name('blog-post-write');
            Route::post('/blog/post/write', 'store')->name('blog-post-write.post-blog');
        });

        // my post controller
        Route::controller(MyPostController::class)->group(function () {
            Route::get('/blog/post/myPost', 'index')->name('blog-my-post');
            Route::post('/blog/post/myPost/store', 'store')->name('blog-my-post.store');
            Route::put('/blog/post/myPost/update/{id}', 'update')->name('blog-my-post.update');
            Route::get('/blog/post/myPost/delete/{id}', 'destroy')->name('blog-my-post.delete');
        });
    });
});

/**
 * dashboard routes
 */
Route::name('dashboard.')
    ->middleware(['auth', 'verified', Admin::class])
    ->group(function () {

    Route::controller(HomeController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
    });

    Route::controller(UsersController::class)->group(function () {
        Route::get('/users', 'index')->name('users');
        Route::get('/users/delete/{id}', 'destroy')->name('users.delete');
    });

    Route::controller(PostsController::class)->group(function () {
        Route::get('/posts', 'index')->name('posts');
        Route::get('/posts/delete/{id}', 'destroy')->name('posts.delete');
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/categories', 'index')->name('categories');
        Route::post('/categories/store', 'store')->name('categories.store');
        Route::put('/categories/update/{id}', 'update')->name('categories.update');
        Route::get('/categories/delete/{id}', 'destroy')->name('categories.delete');
    });

    Route::controller(TagsController::class)->group(function () {
        Route::get('/tags', 'index')->name('tags');
        Route::post('/tags/store', 'store')->name('tags.store');
        Route::put('/tags/update/{id}', 'update')->name('tags.update');
        Route::get('/tags/delete/{id}', 'destroy')->name('tags.delete');
    });
});

/**
 * profile routes
 */
Route::name('profile.')->middleware('auth')->group(function () {

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('edit');
        Route::patch('/profile', 'update')->name('update');
        Route::delete('/profile', 'destroy')->name('destroy');
    });

});

require __DIR__.'/auth.php';
