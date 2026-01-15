<?php

use App\Http\Controllers\AdminQueueController;
use App\Http\Controllers\QueueController;
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

Route::get('/', function () {
    return view('welcome');
});

// Public Queue Routes - Untuk pengunjung mengambil nomor antrian
Route::prefix('queue')->name('queue.')->group(function () {
    Route::get('/', [QueueController::class, 'index'])->name('index');
    Route::post('/', [QueueController::class, 'store'])->name('store');
    Route::get('/print', [QueueController::class, 'printReceipt'])->name('print');
});

Route::get('/get-latest-queue', [QueueController::class, 'getLatestQueue'])
    ->name('queue.latest');

// Admin Queue Routes - Untuk petugas mengelola antrian
Route::prefix('queues')->name('admin.queues.')->group(function () {
    Route::get('/', [AdminQueueController::class, 'index'])->name('index');
    Route::get('/{id}', [AdminQueueController::class, 'process'])->name('process');
    Route::put('/{id}', [AdminQueueController::class, 'complete'])->name('complete');
});
