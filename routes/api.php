<?php

use Illuminate\Http\Request;

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

Route::group(['middleware' => ['auth.hard']], function() {
    Route::resource('data', 'DataController');
});

Route::fallback(function () {
    return response()->json([
        'status' => 'error',
        'message' => 'Not Found'
    ], 404);
});
