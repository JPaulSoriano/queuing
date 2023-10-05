<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QueueController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [QueueController::class, 'index'])->name('queue.index');
Route::post('/reg', [QueueController::class, 'reg'])->name('queue.reg');
Route::get('/call/{registrarNumber}', [QueueController::class, 'callQueue'])->name('queue.call');
Route::post('/call/next/{registrarNumber}', [QueueController::class, 'callNextQueue'])->name('queue.call.next');
Route::post('/call/refresh/{registrarNumber}', [QueueController::class, 'refreshQueue'])->name('queue.refresh');
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
