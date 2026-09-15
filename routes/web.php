<?php

use App\Http\Controllers\Ergo\ErgoAssessmentController;

Route::prefix('ergo')->name('ergo.')->group(function () {
    Route::get('/', [ErgoAssessmentController::class, 'index'])->name('index');
    Route::get('/create', [ErgoAssessmentController::class, 'create'])->name('create');
    Route::post('/store', [ErgoAssessmentController::class, 'store'])->name('store');
    Route::get('/result/{id}', [ErgoAssessmentController::class, 'show'])->name('result');
    
    // Route untuk Cetak PDF LHU Resmi
    Route::get('/pdf/{id}', [ErgoAssessmentController::class, 'exportPdf'])->name('pdf');
});