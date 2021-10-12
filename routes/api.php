<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemCtrl;

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

Route::get('/items', [ItemCtrl::class, 'index']);
Route::prefix('/item')->group( function(){
    Route::post('/store', [ItemCtrl::class, 'store']);
    Route::put('/{id}', [ItemCtrl::class, 'update']);
    Route::delete('/{id}', [ItemCtrl::class, 'destroy']);
});
