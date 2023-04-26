<?php

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
    return view('login');
})->name('login');
Route::get('/auth/{provider}', [App\Http\Controllers\login::class, 'Oauth'])->name('auth');
Route::get('/callback/google', [App\Http\Controllers\login::class, 'GoogleCallback'])->name('google.callback');
Route::get('/callback/facebook', [App\Http\Controllers\login::class, 'FacebookCallback'])->name('facebook.callback');
Route::get('callback/microsoft', [App\Http\Controllers\login::class, 'MicrosoftCallback'])->name('microsoft.callback');

Route::get('/users', [App\Http\Controllers\Users::class, 'index'])->name('users');
Route::get('/user/{id}', [App\Http\Controllers\Users::class, 'show'])->name('users.show');
Route::delete('/user/{id}', [App\Http\Controllers\Users::class, 'delete'])->name('users.delete');
Route::post('/user', [App\Http\Controllers\Users::class, 'update'])->name('users.update');

Route::get('/scheduleReports', [App\Http\Controllers\Reports::class, 'schedule'])->name('reports.schedule');