<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::get('/', [ProjectController::class, 'index'])->name('index')->middleware('permission:projects-read');

    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('permission:projects-read');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });


    /* Projects */

    Route::middleware('permission:projects-read')->group(function () {
        Route::resource('projects', ProjectController::class)->except(['edit', 'update', 'destroy']);
    });

    Route::middleware('permission:projects-update')->group(function () {
        Route::get('projects/{id}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
        Route::put('projects/{id}/update', [ProjectController::class, 'update'])->name('projects.update');
    });

    Route::middleware('permission:projects-delete')->group(function () {
        Route::delete('projects/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');
    });

    Route::post('projects/status/{id}', [ProjectController::class, 'updateStatus'])->name('projects.updateStatus');


    /* Clients */

    Route::resource('clients', ClientController::class)->middleware([
        'index' => 'permission:clients-read',
        'store' => 'permission:clients-create',
        'update' => 'permission:clients-update',
        'destroy' => 'permission:clients-delete'
    ]);


    /* Tasks */

    Route::resource('tasks', TaskController::class)->middleware([
        'index' => 'permission:tasks-read',
        'store' => 'permission:tasks-create',
        'update' => 'permission:tasks-update',
        'destroy' => 'permission:tasks-delete'
    ]);

    Route::post('tasks/status/{id}', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');

    
    /* Users */

    Route::resource('users', UserController::class)->middleware([
        'index' => 'permission:users-read',
        'store' => 'permission:users-create',
        'update' => 'permission:users-update',
        'destroy' => 'permission:users-delete'
    ]);
});

require __DIR__ . '/auth.php';
