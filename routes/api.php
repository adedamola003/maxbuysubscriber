<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\User\SubscriberController;

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});


//real user application Apis
Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1'], function () {
    //Subscriber Routes
    Route::post('subscriber/receive', [SubscriberController::class, 'receiveMessage']);

    Route::middleware(['auth:sanctum', 'verified'])->group(function () {


    });

    Route::fallback(function () {
        return response()->json(['message' => 'Page Not Found'], 404);
    });
});
