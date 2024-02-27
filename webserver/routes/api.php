<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\AuthController;
use App\Http\Controllers\api\v1\ArticleController;
use App\Http\Controllers\api\v1\UserController;
use App\Http\Middleware\v1\ProtectedRouteAuth;


Route::get('/', function () {
    return response()->json(['api_name' => 'article-list', 'api_version' => 'v1.0.0']);
});

Route::prefix('v1')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('user', [UserController::class, 'create']);
    Route::get('article', [ArticleController::class, 'getAll']);
    Route::get('article/{id}', [ArticleController::class, 'getById']);

    Route::middleware([ProtectedRouteAuth::class])->group(function () {
        Route::post('me', [AuthController::class, 'me']);
        Route::post('logout', [AuthController::class, 'logout']);

        
        Route::post('article/', [ArticleController::class, 'create']);

    });
});
