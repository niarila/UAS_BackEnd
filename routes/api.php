<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\Agama14Controller;
use App\Http\Controllers\api\User14Controller;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get("/user14", [User14Controller::class, "getUsers14"]);
Route::get("/user14/{id}", [User14Controller::class, "getUserDetail14"]);
Route::put("/user14/{id}", [User14Controller::class, "putUserDetail14"]);
Route::put("/user14/{id}/foto", [User14Controller::class, "putUserPhoto14"]);
Route::put("/user14/{id}/fotoktp", [User14Controller::class, "putUserPhotoKTP14"]);
Route::put("/user14/{id}/password", [User14Controller::class, "putUserPassword14"]);
Route::put("/user14/{id}/status", [User14Controller::class, "putUserStatus14"]);
Route::put("/user14/{id}/agama", [User14Controller::class, "putUserAgama14"]);
Route::delete("/user14/delete/{id}", [User14Controller::class, "deleteUser14"]);
Route::delete("/user14/deletedata/{id}", [User14Controller::class, "deleteDataUser14"]);
Route::get("/agama14", [Agama14Controller::class, "getAgama14"]);
Route::get("/agama14/{id}", [Agama14Controller::class, "getDetailAgama14"]);
Route::post("/agama14", [Agama14Controller::class, "postAgama14"]);
Route::put("/agama14/{id}", [Agama14Controller::class, "putAgama14"]);
Route::delete("/agama14/{id}", [Agama14Controller::class, "deleteAgama14"]);



