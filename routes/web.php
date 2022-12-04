<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ConsoleController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\JoinController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

    Route::get('consoles/trash', [ConsoleController::class, 'deletelist']);
    Route::get('consoles/trash/{console}/restore', [consoleController::class, 'restore']);
    Route::get('consoles/trash/{console}/forcedelete', [consoleController::class, 'deleteforce']);
    Route::resource('consoles', consoleController::class);

    Route::get('storages/trash', [StorageController::class, 'deletelist']);
    Route::get('storages/trash/{storage}/restore', [storageController::class, 'restore']);
    Route::get('storages/trash/{storage}/forcedelete', [storageController::class, 'deleteforce']);
    Route::resource('storages', storageController::class);

    Route::get('tokos/trash', [TokoController::class, 'deletelist']);
    Route::get('tokos/trash/{toko}/restore', [tokoController::class, 'restore']);
    Route::get('tokos/trash/{toko}/forcedelete', [tokoController::class, 'deleteforce']);
    Route::resource('tokos', tokoController::class);

    Route::get('/totals', [JoinController::class, 'index']);
    
});