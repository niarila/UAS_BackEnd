<?php

use App\Http\Controllers\User14Controller;
use App\Http\Controllers\Agama14Controller;
use App\Http\Controllers\Admin14Controller;
use App\Http\Controllers\apiclient\Agama14Controller as ClientAgama14Controller;
use App\Http\Controllers\apiclient\User14Controller as ClientUser14Controller;
use Illuminate\Support\Facades\Route;

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

//welcome page
Route::get('/', function () {
    return redirect('/login14');
});

Route::group(['middleware' => ['isNotLogin']], function () {
    // Register Login
    Route::view('/register14', 'register');
    Route::view('/login14', 'login');
    Route::post('/register14', [App\Http\Controllers\Register14Controller::class, 'register14']);
    Route::post('/login14', [App\Http\Controllers\Login14Controller::class, 'login14']);
});

// Role Admin
Route::group(['middleware' => ['isAdmin']], function () {

    // API DATA USER
    Route::get('/dashboard14', [User14Controller::class, 'dashboardPage14']);
    Route::get('/user14/{id}', [User14Controller::class, 'detailPage14']);
    Route::get('/user14/{id}/status', [User14Controller::class, 'putUserStatus14']);
    Route::post('/user14/{id}/agama', [User14Controller::class, 'putUserAgama14']);
    Route::get('/user14/{id}/delete', [Admin14Controller::class, "deleteUser14"]);

    // API AGAMA
    Route::get("/agama14", [Agama14Controller::class, "agamaPage14"]);
    Route::post("/agama14", [Agama14Controller::class, "createAgama14"]);
    Route::get("/agama14/{id}/edit", [Agama14Controller::class, "editAgamaPage14"]);
    Route::post("/agama14/{id}/update", [Agama14Controller::class, "updateAgama14"]);
    Route::get("/agama14/{id}/delete", [Agama14Controller::class, "deleteAgama14"]);

    // API CLIENT DATA USER
    Route::get("/apiclient/dashboard14", [ClientUser14Controller::class, "dashboardPage14"]);
    Route::get("/apiclient/user14/{id}", [ClientUser14Controller::class, "detailPage14"]);
    Route::get("/apiclient/user14/{id}/status", [ClientUser14Controller::class, "putUserStatus14"]);
    Route::post("/apiclient/user14/{id}/agama", [ClientUser14Controller::class, "putUserAgama14"]);
    Route::get("/apiclient/user14/{id}/delete", [ClientUser14Controller::class, "deleteUser14"]);

    // API CLIENT AGAMA
    Route::get("/apiclient/agama14", [ClientAgama14Controller::class, "agamaPage14"]);
    Route::get("/apiclient/agama14/{id}/edit", [ClientAgama14Controller::class, "editAgamaPage14"]);
    Route::post("/apiclient/agama14", [ClientAgama14Controller::class, "createAgama14"]);
    Route::post("/apiclient/agama14/{id}/update", [ClientAgama14Controller::class, "updateAgama14"]);
    Route::get("/apiclient/agama14/{id}/delete", [ClientAgama14Controller::class, "deleteAgama14"]);


});


// Role User
Route::group(['middleware' => ['isUser']], function () {

    // API User
    Route::view('/changePassword14', 'editPW');
    Route::get('/profile14', [User14Controller::class, 'profilePage14']);
    Route::post('/user14', [User14Controller::class, 'putUserDetail14']);
    Route::post('/user14/photo', [User14Controller::class, 'putUserPhoto14']);
    Route::post('/user14/photoKTP', [User14Controller::class, 'putUserPhotoKTP14']);
    Route::post('/user14/password', [User14Controller::class, 'putUserPassword14']);

    // API Client User
    Route::view('/apiclient/changePassword14', 'editPW', ['Use_API' => true]);
    Route::get('/apiclient/profile14', [ClientUser14Controller::class, 'profilePage14']);
    Route::post('/apiclient/user14', [ClientUser14Controller::class, 'putUserDetail14']);
    Route::post('/apiclient/user14/photo', [ClientUser14Controller::class, 'putUserPhoto14']);
    Route::post('/apiclient/user14/photoKTP', [ClientUser14Controller::class, 'putUserPhotoKTP14']);
    Route::post('/apiclient/user14/password', [ClientUser14Controller::class, 'putUserPassword14']);


});

// Welcome Page
Route::get('/halo14', [App\Http\Controllers\Halo14Controller::class, 'halo14']);

// Logout Session
Route::get('/logout14', [User14Controller::class, 'logout14'])->middleware('isLogin');
