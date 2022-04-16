<?php

use App\Http\Controllers\Api\DeviceController;
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

Route::middleware('auth')->resource('school', SchoolController::class, ['as' => 'api']);
Route::middleware('auth')->get('school/{school}/users', [SchoolController::class, 'users'])->name('school.users');
Route::middleware('auth')->post('school/{school}/add-user', [SchoolController::class, 'add_user'])->name('school.users');
Route::middleware('auth')->resource('score', ScoreController::class, ['as' => 'api']);

Route::resource('device', DeviceController::class, ['as' => 'api']);
Route::post('device/register/{id}', [DeviceController::class, 'register'], ['as' => 'api']);
Route::middleware('auth')->post('device/claim/{code}', [DeviceController::class, 'claim'], ['as' => 'api']);
