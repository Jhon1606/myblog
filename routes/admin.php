<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TagController;
use Illuminate\Support\Facades\Route;

Route::get('', [HomeController::class, 'index'])->name('admin.home');
// Aquí le decimos que la url comenzaran por categories, Ej: (categories/create, categories/2/edit) 
// y se llamaran por admin.categories, Ej: admin.categories.create
Route::resource('categories', CategoryController::class)->names('admin.categories');
Route::resource('tags', TagController::class)->names('admin.tags');
Route::resource('posts', PostController::class)->names('admin.posts');
