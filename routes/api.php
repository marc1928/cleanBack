<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\QuestionnaireController;
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

Route::middleware('auth:sanctum')->group(function (){
    Route::get('/user', function (Request $request){
        return $request->user();
    });
    Route::post('logout',[AuthController::class,'logout']);
});

Route::post('signup',[AuthController::class,'signup']);
Route::post('login',[AuthController::class,'login']);
Route::get('/forgetpassword/{email}', [AuthController::class, 'forgetPassword']);

Route::get('users',[UserController::class,'users']);
Route::get('/users/{user}', [UserController::class, 'show']);
Route::put('/setprofile/{userId}', [UserController::class, 'update']);
Route::put('/setstate/{id}/{newState}', [UserController::class, 'setstate']);

Route::post('storenotification',[NotificationController::class,'store']);
Route::get('/notification/{userId}', [NotificationController::class, 'getNotification']);
Route::get('/notification-unread/{userId}', [NotificationController::class, 'getNotificationUnRead']);
Route::put('/setstatenotification/{id}/{newState}', [NotificationController::class, 'update']);

Route::apiResource('questionnaires', QuestionnaireController::class);
Route::put('/setstatequestionnaire/{id}/{newState}', [QuestionnaireController::class, 'setstate']);

Route::apiResource('questions', QuestionController::class);
Route::put('/setstatequestion/{id}/{newState}', [QuestionController::class, 'setstate']);
