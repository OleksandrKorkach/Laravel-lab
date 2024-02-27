<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {

    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::resource('projects', ProjectController::class);

    Route::prefix('projects')->group(function () {
        Route::post('/add-member', [ProjectController::class, 'addMember'])->name('projects.add-member');
        Route::delete('/delete-member', [ProjectController::class, 'deleteMember'])->name('projects.delete-member');
        Route::get('/{projectId}/search-available-users', [ProjectController::class, 'searchAvailableUsers'])->name('projects.search-available-users');
        Route::post('/{projectId}/store-statuses', [ProjectController::class, 'storeStatuses'])->name('projects.statuses.store');
    });

    Route::prefix('tasks')->group(function () {
        Route::post('/', [TaskController::class, 'store'])->name('tasks.store');
        Route::delete('/', [TaskController::class, 'destroy'])->name('tasks.destroy');
        Route::delete('/delete-assignee', [TaskController::class, 'deleteAssignee'])->name('tasks.delete-assignee');
    });


});

require __DIR__.'/auth.php';
