<?php

use App\Http\Controllers\Api\SchoolController;
use App\Http\Controllers\Api\ScoreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('school', SchoolController::class, ['as' => 'api']);
Route::get('school/{school}/users', [SchoolController::class, 'users'])->name('school.users');
Route::post('school/{school}/add-user', [SchoolController::class, 'add_user'])->name('school.users');
Route::resource('score', ScoreController::class, ['as' => 'api']);
