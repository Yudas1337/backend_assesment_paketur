<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Middleware\JwtMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('auth')->group(function () {
    Route::post('login', LoginController::class)->name('login');
});

Route::middleware([JwtMiddleware::class])->group(function () {
    Route::get('user', fn(Request $request) => $request->user());
    Route::post('logout', LogoutController::class);
});

