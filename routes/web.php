<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LearnerProgressController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::group(['prefix' => 'learner-progress', 'as' => 'learner-progress.'], function () {
    Route::get('/', [LearnerProgressController::class, 'index'])->name('index');
    Route::get('/{learner}', [LearnerProgressController::class, 'show'])->name('show');
});
