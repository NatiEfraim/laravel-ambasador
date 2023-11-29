<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Group;
// use App\Http\Requests\RegisterRequest;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!



|Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
|
|
|


*/
// Group of admin endpoints
Route::prefix('admin')->group(function () {
    // Endpoint - api/admin/register
    Route::post('register', [AuthController::class, 'register']);
    // Endpoint - api/admin/login
    Route::post('login', [AuthController::class, 'login']);

    // Group of admin middleware endpoints
    Route::middleware(['auth:sanctum'])->group(function () {
        // Endpoint - api/admin/user
        Route::get('user', [AuthController::class, 'user']);
    });
});
