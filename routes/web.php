<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SalesController;

// Route::get('/upload', [SalesController::class, 'index']);
// Route::post('/upload', [SalesController::class, 'upload']);
// Route::get('/batch', [SalesController::class, 'batch']);
// Route::get('/batch/in-progress', [SalesController::class, 'batchInProgress']);

Route::post('/upload', function(){
    if(request()->has('mycsv')){

        $data = array_map('str_getcsv', file(request()->mycsv));
        return $data[0];
    }
    return "please upload file";
});

Route::get('/upload', function(){
    return view('upload-file');
});