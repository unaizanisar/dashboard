<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Blogs\CategoryController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Blogs\BlogController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
Route::get('/inactive', function () {
    return view('auth.inactive');
})->name('inactive');
Route::get('/', function () {
    return view('login');
});
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
// Users
Route::middleware(['auth'])->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.delete');
    Route::get('/users/{id}/status/{status}', [UserController::class, 'updateStatus'])->name('users.status');
});
// Profile
Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
// Categories
Route::middleware(['auth'])->group(function () {
    Route::get('/category', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.delete');
    Route::get('/categories/{id}/status/{status}', [CategoryController::class, 'updateStatus'])->name('categories.status');
});
// Roles
Route::middleware(['auth'])->group(function () {
    Route::get('/role', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles/store', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/{id}', [RoleController::class, 'show'])->name('roles.show');
    Route::get('/roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::post('/roles/{id}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles/{id}', [RoleController::class, 'destroy'])->name('roles.delete');
    Route::get('/roles/{id}/status/{status}', [RoleController::class, 'updateStatus'])->name('roles.status');
});
// Permissions
Route::middleware(['auth'])->group(function () {
    Route::get('/permission', [PermissionController::class, 'index'])->name('permissions.index');
    Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::post('/permissions/store', [PermissionController::class, 'store'])->name('permissions.store');
    Route::get('/permissions/{id}', [PermissionController::class, 'show'])->name('permissions.show');
    Route::get('/permissions/{id}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::post('/permissions/{id}', [PermissionController::class, 'update'])->name('permissions.update');
    Route::delete('/permissions/{id}', [PermissionController::class, 'destroy'])->name('permissions.delete');
    Route::get('/permissions/{id}/status/{status}', [PermissionController::class, 'updateStatus'])->name('permissions.status');
});
// Blogs
Route::middleware(['auth'])->group(function () {
    Route::get('/blog', [BlogController::class, 'index'])->name('blogs.index');
    Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
    Route::post('/blogs/store', [BlogController::class, 'store'])->name('blogs.store');
    Route::get('/blogs/{id}', [BlogController::class, 'show'])->name('blogs.show');
    Route::get('/blogs/{id}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
    Route::post('/blogs/{id}', [BlogController::class, 'update'])->name('blogs.update');
    Route::delete('/blogs/{id}', [BlogController::class, 'destroy'])->name('blogs.delete');
    Route::get('/blogs/{id}/status/{status}', [BlogController::class, 'updateStatus'])->name('blogs.status');
});
// Route::middleware(['auth', 'check.permissions'])->group(function () {
