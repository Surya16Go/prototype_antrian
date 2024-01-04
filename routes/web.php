<?php

use App\Http\Controllers\QueueController;
use App\Http\Controllers\QueuesController;
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
Route::get('/get-latest-queue',[QueueController::class, 'getLatestQueue']);
Route::get('/queue/print', [QueueController::class,'printReceipt']);
Route::get('/queue', [QueueController::class, 'index'])->name('queue.index');
Route::post('/queue', [QueueController::class, 'store'])->name('queue.store');
Route::get('/queues', [QueuesController::class, 'index'])->name('queues.index');
Route::get('/queues/{id}', [QueuesController::class, 'show'])->name('queues.show');
Route::PUT('/queues/{id}', [QueuesController::class, 'update'])->name('queues.update');
