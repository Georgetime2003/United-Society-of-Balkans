<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\DeleteEvent;
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
/**
 * Route to login page
 * @param none
 * @return view login
 */
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('home');
    }
    return view('login');
})->name('home');


Route::get('/login', function(){
    if (Auth::check()) {
        return redirect()->route('home');
    }
    return view('login');
});
Route::post('/login', [App\Http\Controllers\login::class, 'sLoginCallback'])->name('login');

/**
 * Route to login with the selected provider
 * @param string provider
 * @return redirect to the provider
 */
Route::get('/auth/{provider}', [App\Http\Controllers\login::class, 'Oauth'])->name('auth');

/**
 * Route to the callback of the selected provider
 * @param none
 * @return redirect to the callback
 */
Route::get('/callback/google', [App\Http\Controllers\login::class, 'GoogleCallback'])->name('google.callback');
Route::get('/callback/facebook', [App\Http\Controllers\login::class, 'FacebookCallback'])->name('facebook.callback');
Route::get('callback/microsoft', [App\Http\Controllers\login::class, 'MicrosoftCallback'])->name('microsoft.callback');

/**
 * Route to logout
 * @param none
 * @return redirect to the login page
 */
Route::get('/logout', [App\Http\Controllers\login::class, 'logout'])->name('logout');

Route::get('/passwordEmailUser', function(){
    return view('regeneratePasswordMail');
})->name('passwordEmailUser');
Route::post('/passwordEmailUser', [App\Http\Controllers\Users::class, 'sendPasswordEmail'])->name('passwordEmailUser');

Route::get('/users', [App\Http\Controllers\Users::class, 'index'])->name('users')->middleware('auth')->middleware('isAdmin');
Route::get('/user/config', [App\Http\Controllers\Users::class, 'config'])->name('users.config')->middleware('auth');
Route::post('/user/delete/{id}', [App\Http\Controllers\Users::class, 'delete'])->name('users.delete')->middleware('auth')->middleware('isAdmin');
Route::get('/user/{id}', [App\Http\Controllers\Users::class, 'show'])->name('users.show')->middleware('auth')->middleware('isAdmin');
Route::post('/user', [App\Http\Controllers\Users::class, 'update'])->name('users.update')->middleware('auth')->middleware('isAdmin');
Route::put('/user/updateAvatar', [App\Http\Controllers\Users::class, 'saveAvatar'])->name('users.updateAvatar');
Route::get('/user/regeneratePassword/{userId}', [App\Http\Controllers\Users::class, 'regeneratePassword'])->name('user.regenerate')->middleware('isAdmin');

Route::get('/reports', [App\Http\Controllers\Reports::class, 'index'])->name('reports')->middleware('auth')->middleware('isAdmin');
Route::get('/reports/{userid}', [App\Http\Controllers\Reports::class, 'listUser'])->name('reports.userList')->middleware('auth')->middleware('isAdminorVolunteer');
Route::get('/reports/{userid}/{reportid}', [App\Http\Controllers\Reports::class, 'show'])->name('reports.show')->middleware('auth')->middleware('isAdminorVolunteer');
Route::post('/weeklyreport/update', [App\Http\Controllers\Reports::class, 'updateweekly'])->name('reports.updateweekly')->middleware('auth')->middleware('isVolunteer');

Route::get('/organization/{volunteerId}/{organizationId}/fill/{reportId}', [App\Http\Controllers\OrganizationReports::class, 'fill'])->name('organization.fill')->middleware('auth')->middleware('isAdminorOrganization');
Route::get('/organizations', [App\Http\Controllers\OrganizationReports::class, 'index'])->name('organizations')->middleware('auth')->middleware('isAdmin');
Route::get('/organization/pdf/{reportId}', [App\Http\Controllers\OrganizationReports::class, 'downloadPDF'])->name('organization.downloadPDF')->middleware('auth')->middleware('isAdmin');
Route::post('/organization/save/{reportId}', [App\Http\Controllers\OrganizationReports::class, 'save'])->name('organization.save')->middleware('auth')->middleware('isOrganization');
Route::get('/organization/{id}', [App\Http\Controllers\OrganizationReports::class, 'showVolunteers'])->name('organization.volunteers')->middleware('auth')->middleware('isAdminorOrganization');
Route::get('/organization/{organizationId}/{volunteerId}', [App\Http\Controllers\OrganizationReports::class, 'show'])->name('organization.show')->middleware('auth')->middleware('isAdminorOrganization');
Route::get('/organization/{volunteerId}/{organizationId}/generate/{type}', [App\Http\Controllers\OrganizationReports::class, 'create'])->middleware('auth')->name('organization.create')->middleware('isAdminorOrganization');




Route::get('/home', function () {
    return view('home');
})->name('home')->middleware('auth');

Route::get('/pushWeeklyReport', [App\Http\Controllers\PushController::class, 'pushWeeklyReport'])->name('push');

Route::get('/forum', [App\Http\Controllers\Forum::class, 'index'])->name('forum')->middleware('auth');
Route::post('/forum', [App\Http\Controllers\Forum::class, 'create'])->name('forum.create')->middleware('auth')->middleware('isAdmin');
Route::get('/forum/{id}', [App\Http\Controllers\Forum::class, 'viewForum'])->name('forum.viewForum')->middleware('auth');
Route::get('/forum/{idforum}/post', [App\Http\Controllers\Forum::class, 'createPost_index'])->name('forum.createPost')->middleware('auth');
Route::post('/forum/{idforum}/post', [App\Http\Controllers\Forum::class, 'createPost'])->name('forum.createPost')->middleware('auth');
Route::get('/forum/{idforum}/{idpost}', [App\Http\Controllers\Forum::class, 'viewPost'])->name('forum.viewPost')->middleware('auth');
Route::post('/comment', [App\Http\Controllers\Forum::class, 'createComment'])->name('forum.createComment')->middleware('auth');
Route::post('/post/delete', [App\Http\Controllers\Forum::class, 'deletePost'])->name('forum.deletePost')->middleware('auth');
Route::post('/post/upvote', [App\Http\Controllers\Forum::class, 'upvote'])->name('forum.upvotePost')->middleware('auth');
Route::post('/post/delupvote', [App\Http\Controllers\Forum::class, 'deleteUpvote'])->name('forum.downvotePost')->middleware('auth');
Route::patch('/fcm-token', [App\Http\Controllers\TokenUpdater::class, 'updateToken'])->name('fcmToken');


Route::post('/crear-cita', [CitaController::class, 'crear'])->name('crear-cita');
Route::delete('/delete-event', [DeleteEvent::class, 'destroy'])->name('delete-event');

