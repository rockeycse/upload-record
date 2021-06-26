<?php

use App\Http\Controllers\SalesController;
use Illuminate\Support\Facades\Route;

// Route::get('/upload', [SalesController::class, 'index']);
// Route::post('/upload', [SalesController::class, 'upload']);
// Route::get('/batch', [SalesController::class, 'batch']);
// Route::get('/batch/in-progress', [SalesController::class, 'batchInProgress']);

Route::post('/upload', [SalesController::class, 'upload']);
Route::get('/upload', [SalesController::class, 'index']);
Route::get('/batch', [SalesController::class, 'batch']);
Route::get('/batch/in-progress', [SalesController::class, 'batchInProgress']);

// Route::get('/upload', function(){
//     return view('upload-file');
// });