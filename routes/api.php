<?php

use App\Http\Controllers\Api\ActivityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NotiController;
use App\Http\Controllers\Api\WordController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Api\AddNewController;
use App\Http\Controllers\Api\SurverController;
use App\Http\Controllers\Api\AnnouncementController;
use App\Http\Controllers\Api\CommunicationController;
use App\Http\Controllers\Api\FotoController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class , 'logout']);
});
Route::post('/register', [AuthController::class , 'register']);
Route::post('/login', [AuthController::class , 'login']);
Route::get('/test', [NotiController::class , 'test']);
Route::post('/test', [NotiController::class , 'test']);




Route::apiResources([
   'noti' =>  NotiController::class,
   'announce' => AnnouncementController::class,
   'news' => AddNewController::class,
   'survey' => SurverController::class,
   'words' => WordController::class, 
   'activity' => ActivityController::class,
   'foto' => FotoController::class  
]);


Route::apiResource('commun',CommunicationController::class)
->middleware('throttle:only_communication',['only' => ['store']]);

