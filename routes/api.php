<?php

use App\Http\Controllers\AmbassadorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Models\Link;
use App\Models\Product;
// use App\Models\Link;
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

function common(string $scope)
{
    // Endpoint - api/admin/register
    Route::post('register', [AuthController::class, 'register']);
    // Endpoint - api/admin/login
    Route::post('login', [AuthController::class, 'login']);
    // Group of admin middleware endpoints
    Route::middleware(['auth:sanctum', $scope])->group(function () {
        // Endpoint - api/admin/user
        Route::get('user', [AuthController::class, 'user']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::put('users/info', [AuthController::class, 'updateInfo']);
        Route::put('users/password', [AuthController::class, 'updatePassword']);
    });
}

// Group of admin endpoints
Route::prefix('admin')->group(function () {
    // // Endpoint - api/admin/register
    // Route::post('register', [AuthController::class, 'register']);
    // // Endpoint - api/admin/login
    // Route::post('login', [AuthController::class, 'login']);

    common("scope.admin"); ////set init CRUD

    // Group of admin middleware endpoints
    Route::middleware(['auth:sanctum', 'scope.admin'])->group(function () {
        // // Endpoint - api/admin/user
        // Route::get('user', [AuthController::class, 'user']);
        // Route::post('logout', [AuthController::class, 'logout']);
        // Route::put('users/info', [AuthController::class, 'updateInfo']);
        // Route::put('users/password', [AuthController::class, 'updatePassword']);

        Route::get('ambassador', [AmbassadorController::class, 'index']);
        Route::apiResource("products", ProductController::class);
        Route::get("users/{id}/links", [LinkController::class, 'index']);
        Route::get("orders", [OrderController::class, 'index']);
    });
});


///////Routes for ambassador
// Group of admin endpoints
Route::prefix('ambassador')->group(function () {
    common("scope.ambassador"); ////set init CRUD
    Route::get("products/frontend", [ProductController::class, "frontend"]);
    Route::get("products/backend", [ProductController::class, "backend"]);

    // // Endpoint - api/admin/register
    // Route::post('register', [AuthController::class, 'register']);
    // // Endpoint - api/admin/login
    // Route::post('login', [AuthController::class, 'login']);
    // // Group of admin middleware endpoints
    // Route::middleware(['auth:sanctum', 'scope.ambassador'])->group(function () {
    //     // Endpoint - api/admin/user
    //     Route::get('user', [AuthController::class, 'user']);
    //     Route::post('logout', [AuthController::class, 'logout']);
    //     Route::put('users/info', [AuthController::class, 'updateInfo']);
    //     Route::put('users/password', [AuthController::class, 'updatePassword']);
    // });
});
