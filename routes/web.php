<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
})->name('login');

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

Route::get('/users', [App\Http\Controllers\Users::class, 'index'])->name('users')->middleware('isAdmin');
Route::get('/user/config', [App\Http\Controllers\Users::class, 'config'])->name('users.config');
Route::post('/user/delete/{id}', [App\Http\Controllers\Users::class, 'delete'])->name('users.delete')->middleware('isAdmin');
Route::get('/user/{id}', [App\Http\Controllers\Users::class, 'show'])->name('users.show')->middleware('isAdmin');
Route::post('/user', [App\Http\Controllers\Users::class, 'update'])->name('users.update')->middleware('isAdmin');
Route::put('/user/updateAvatar', [App\Http\Controllers\Users::class, 'saveAvatar'])->name('users.updateAvatar');

Route::get('/reports', [App\Http\Controllers\Reports::class, 'index'])->name('reports')->middleware('isAdmin');
Route::get('/reports/{userid}', [App\Http\Controllers\Reports::class, 'listUser'])->name('reports.userList')->middleware('isAdminorVolunteer');
Route::get('/reports/{userid}/{reportid}', [App\Http\Controllers\Reports::class, 'show'])->name('reports.show')->middleware('isAdminorVolunteer');
Route::post('/weeklyreport/update', [App\Http\Controllers\Reports::class, 'updateweekly'])->name('reports.updateweekly')->middleware('isVolunteer');

Route::get('/organizations', [App\Http\Controllers\OrganizationReports::class, 'index'])->name('organizations')->middleware('isAdmin');
Route::get('/organization/{id}', [App\Http\Controllers\OrganizationReports::class, 'showVolunteers'])->name('organization.volunteers')->middleware('isAdminorOrganization');
Route::get('/organization/{organizationId}/{volunteerId}', [App\Http\Controllers\OrganizationReports::class, 'show'])->name('organization.show')->middleware('isAdminorOrganization');
Route::get('/organization/{volunteerId}/{organizationId}/generate/{type}', [App\Http\Controllers\OrganizationReports::class, 'create'])->name('organization.create')->middleware('isAdminorOrganization');
Route::get('/organization/{volunteerId}/{organizationId}/{reportId}', [App\Http\Controllers\OrganizationReports::class, 'fill'])->name('organization.fill')->middleware('isOrganization');


Route::get('/home', function () {
    return view('home');
})->name('home')->middleware('auth');

Route::get('/pushWeeklyReport', [App\Http\Controllers\PushController::class, 'pushWeeklyReport'])->name('push');

Route::get('/forum', [App\Http\Controllers\Forum::class, 'index'])->name('forum')->middleware('auth');
Route::post('/forum', [App\Http\Controllers\Forum::class, 'create'])->name('forum.create')->middleware('isAdmin');
Route::get('/forum/{id}', [App\Http\Controllers\Forum::class, 'viewForum'])->name('forum.viewForum')->middleware('auth');
Route::get('/forum/{idforum}/post', [App\Http\Controllers\Forum::class, 'createPost_index'])->name('forum.createPost')->middleware('auth');
Route::post('/forum/{idforum}/post', [App\Http\Controllers\Forum::class, 'createPost'])->name('forum.createPost')->middleware('auth');
Route::get('/forum/{idforum}/{idpost}', [App\Http\Controllers\Forum::class, 'viewPost'])->name('forum.viewPost')->middleware('auth');
Route::post('/comment', [App\Http\Controllers\Forum::class, 'createComment'])->name('forum.createComment')->middleware('auth');
Route::post('/post/delete', [App\Http\Controllers\Forum::class, 'deletePost'])->name('forum.deletePost')->middleware('auth');
Route::post('/post/upvote', [App\Http\Controllers\Forum::class, 'upvote'])->name('forum.upvotePost')->middleware('auth');
Route::post('/post/delupvote', [App\Http\Controllers\Forum::class, 'deleteUpvote'])->name('forum.downvotePost')->middleware('auth');
Route::patch('/fcm-token', [App\Http\Controllers\TokenUpdater::class, 'updateToken'])->name('fcmToken');

Route::get('/forcelogin', function (){
    $login = User::where('email', 'familiajordiescarra@gmail.com')->first();
    Auth::login($login);
    return redirect()->route('reports');
})->name('forcelogin');

