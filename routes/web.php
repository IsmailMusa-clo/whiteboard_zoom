<?php

use App\Http\Controllers\ZoomAuthController;
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
    return view('welcome');
});
Route::get('/zoom/auth/login',[ZoomAuthController::class, 'login'])->name('zoom.auth.login');
Route::get('/zoom/auth/callback', [ZoomAuthController::class, 'callback'])->name('zoom.auth.callback');
Route::get('/zoom/auth/call', [ZoomAuthController::class, 'callZoomApi'])->name('zoom.auth.call');
