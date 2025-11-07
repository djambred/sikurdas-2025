<?php

use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use App\Http\Controllers\CourseTreeExportController;

/* NOTE: Do Not Remove
/ Livewire asset handling if using sub folder in domain
*/
Livewire::setUpdateRoute(function ($handle) {
    return Route::post(config('app.asset_prefix') . '/livewire/update', $handle);
});

Livewire::setScriptRoute(function ($handle) {
    return Route::get(config('app.asset_prefix') . '/livewire/livewire.js', $handle);
});
/*
/ END
*/
Route::get('/', function () {
    return view('welcome');
});
Route::get('/course-tree/pdf', [CourseTreeExportController::class, 'exportPdf'])
    ->name('course-tree.pdf');

// 👁️ Preview HTML (opsional, untuk tes di browser)
Route::get('/course-tree/preview', [CourseTreeExportController::class, 'preview'])
    ->name('course-tree.preview');
