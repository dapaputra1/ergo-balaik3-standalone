<?php

use App\Http\Controllers\Ergo\ErgoAssessmentController;
use Illuminate\Support\Facades\Route;

// 1. Redirect root URL (/) langsung ke halaman utama modul ergonomi
Route::redirect('/', '/ergo');

// 2. Grup rute modul Ergonomi Balai K3
Route::prefix('ergo')->name('ergo.')->controller(ErgoAssessmentController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/result/{id}', 'show')->name('result');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::put('/update/{id}', 'update')->name('update');
    Route::delete('/destroy/{id}', 'destroy')->name('destroy');

    // Cetak PDF LHU Resmi
    Route::get('/pdf/{id}', [ErgoAssessmentController::class, 'exportPdf'])->name('pdf');
    Route::get('/lhu/editor/{id}', [ErgoAssessmentController::class, 'editLhu'])->name('lhu.edit');
    Route::put('/lhu/update/{id}', [ErgoAssessmentController::class, 'updateLhu'])->name('lhu.update');
});