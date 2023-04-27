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

Route::get('/users', [App\Http\Controllers\Users::class, 'index'])->middleware('isAdmin')->name('users');
Route::get('/user/config', [App\Http\Controllers\Users::class, 'config'])->middleware('isLogged')->name('users.config');
Route::get('/user/{id}', [App\Http\Controllers\Users::class, 'show'])->name('users.show');
Route::delete('/user/{id}', [App\Http\Controllers\Users::class, 'delete'])->name('users.delete');
Route::post('/user', [App\Http\Controllers\Users::class, 'update'])->name('users.update');


Route::get('/reports', [App\Http\Controllers\Reports::class, 'index'])->name('reports');
Route::get('/reports/{userid}', [App\Http\Controllers\Reports::class, 'listUser'])->name('reports.userList');
Route::get('/reports/{userid}/{reportid}', [App\Http\Controllers\Reports::class, 'show'])->name('reports.show');