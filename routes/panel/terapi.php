<?php

use App\Http\Controllers\TerapiController;

Route::get('/', [TerapiController::class, 'index'])->name('terapi')->middleware('rbac:terapi');
Route::get('/data', [TerapiController::class, 'data'])->name('terapi.data')->middleware('rbac:terapi');
Route::post('/store', [TerapiController::class, 'store'])->name('terapi.store')->middleware('rbac:terapi,2');
Route::patch('/tanggapan', [TerapiController::class, 'tanggapan'])->name('terapi.tanggapan')->middleware('rbac:terapi,3');
Route::patch('/update', [TerapiController::class, 'update'])->name('terapi.update')->middleware('rbac:terapi,3');
Route::delete('/delete', [TerapiController::class, 'delete'])->name('terapi.delete')->middleware('rbac:terapi,4');
Route::get('/export', [TerapiController::class, 'export'])->name('terapi.export')->middleware('rbac:terapi');
