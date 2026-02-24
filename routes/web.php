<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\CalculatorController::class, 'index'])->name('calculator');

Route::post('/result',[\App\Http\Controllers\CalculatorController::class,'result'] )->name('result');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('bmi')->group(function () {
    Route::get('/', [App\Http\Controllers\BmiController::class, 'index'])->name('bmi.index');
    Route::post('/calculate', [App\Http\Controllers\BmiController::class, 'calculate'])->name('bmi.calculate');
    Route::get('/history', [App\Http\Controllers\BmiController::class, 'history'])->name('bmi.history');
});