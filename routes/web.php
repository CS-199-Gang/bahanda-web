<?php

use App\Http\Controllers\DeviceController;
use App\Http\Controllers\DeviceSettingsController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\ScoreController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

Route::middleware('auth')->resource('/schools', SchoolController::class);
// School Admin view for users
Route::middleware('auth')->get('/users', [SchoolController::class, 'show'])->name('schools.users');
Route::middleware('auth')->resource('/scores', ScoreController::class);
Route::middleware('auth')->resource('/devices', DeviceController::class);
Route::middleware('auth')->resource('/device-settings', DeviceSettingsController::class);
