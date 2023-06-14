<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::prefix('auth')->group(
    function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::get('profile', [AuthController::class, 'profile']);
    }
);


Route::prefix('asset')->middleware('auth:api')->group(
    function () {
    Route::get('/', [AssetController::class, 'index']);
    Route::get('show/{asset}', [AssetController::class, 'show']);
    Route::post('store', [AssetController::class, 'store']);
    Route::post('update/{asset}', [AssetController::class, 'update']);
    Route::get('delete/{asset}', [AssetController::class, 'destroy']);
    }
);

Route::middleware('role:user')->group(function () {
    // Rute-rute yang hanya dapat diakses oleh pengguna dengan peran "user"
    Route::get('/user/profile', [UserController::class, 'profile']);
    // ...
});
