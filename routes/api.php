<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group([
    'middleware' => ['api','cors', 'json.response'],
], function () {
    Route::post('/login', [AuthController::class,'login']);
    Route::post('/logout', [AuthController::class,'logout']);
    Route::post('/refresh', [AuthController::class,'refresh']);
    Route::get('/me', [AuthController::class,'me']);

});
Route::group([
    'middleware' => ['api','cors', 'json.response'],
    'prefix' => 'posts'
], function () {
    Route::get('/index', [PostController::class,'index']);
    // Route::post('/update', [PostController::class,'update']);
    Route::post('/create', [PostController::class,'create']);
    // Route::get('/delete', [PostController::class,'delete']);

});