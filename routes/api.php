<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\ApiLoginController;
use App\Http\Controllers\Blogs\BlogController;
use App\Http\Controllers\Blogs\CategoryController;
use App\Http\Controllers\Admin\PermissionController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('register',[RegisterController::class,'register']);
Route::post('login',[ApiLoginController::class,'login']);
Route::post('logout',[LoginController::class,'apiLogout']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('profile', [ProfileController::class, 'apiShow']);
    Route::post('profile/update', [ProfileController::class, 'apiUpdate']);

    Route::get("users/list",[UserController::class,'list']);
    Route::post('users/store', [UserController::class, 'apiStore']);
    Route::delete("users/destroy/{id}",[UserController::class,'apiDestroy']);
    Route::get('users/{id}', [UserController::class, 'apiShow']);
    Route::put('users/{id}', [UserController::class, 'apiUpdate']);
    //Route::patch('users/{id}/status/{status}', [UserController::class, 'apiUpdateStatus']);
    Route::get("blogs/list",[BlogController::class,'list']);
    Route::post('blogs/store', [BlogController::class, 'apiStore']);
    Route::get('blogs/show/{id}', [BlogController::class, 'apiShow']);
    Route::put('blogs/update/{id}', [BlogController::class, 'apiUpdate']);
    Route::delete('blogs/destroy/{id}', [BlogController::class, 'apiDestroy']);

    Route::get("category/list",[CategoryController::class,'list']);
    Route::post('category/store', [CategoryController::class, 'apiStore']);
    Route::get('category/show/{id}', [CategoryController::class, 'apiShow']);
    Route::put('category/update/{id}', [CategoryController::class, 'apiUpdate']);
    Route::delete('category/destroy/{id}', [CategoryController::class, 'apiDestroy']);

    Route::get("search/{name}",[RoleController::class,'search']);
    Route::get("role/list",[RoleController::class,'list']);
    Route::post('role/store', [RoleController::class, 'apiStore']);
    Route::get('role/show/{id}', [RoleController::class, 'apiShow']);
    Route::put('role/update/{id}', [RoleController::class, 'apiUpdate']);
    Route::delete('role/destroy/{id}', [RoleController::class, 'apiDestroy']);

    Route::get("permission/list",[PermissionController::class,'list']);
    Route::post('permission/store', [PermissionController::class, 'apiStore']);
    Route::get('permission/show/{id}', [PermissionController::class, 'apiShow']);
    Route::put('permission/update/{id}', [PermissionController::class, 'apiUpdate']);
    Route::delete('permission/destroy/{id}', [PermissionController::class, 'apiDestroy']);

});
