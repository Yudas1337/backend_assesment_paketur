<?php

use App\Enums\RoleEnum;
use App\Http\Controllers\Api\Company\StoreCompanyController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\Api\Manager\UpdateManagerController;
use App\Http\Controllers\Api\ManagerController;
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

Route::middleware(['role:' . RoleEnum::MANAGER->value])->group(function () {
    Route::patch('update-manager', UpdateManagerController::class);
    Route::apiResource('employees', EmployeeController::class)->only('store', 'update', 'destroy');
});

Route::middleware('role:' . RoleEnum::MANAGER->value . '|' . RoleEnum::EMPLOYEE->value)->group(function () {
    Route::apiResource('employees', EmployeeController::class)->only('index', 'show');
});


Route::middleware(['role:' . RoleEnum::SUPER_ADMIN->value])->group(function () {
    Route::post('companies', StoreCompanyController::class);
});
