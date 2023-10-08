<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

//public Routes
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);



//Protected Routes
Route::group(['middleware' => ['auth:sanctum']],function(){
Route::post('/students',[AuthController::class,'store']);
Route::get('/students',[AuthController::class,'index']);
Route::get('/students/{id}',[AuthController::class,'show']);
Route::put('/students/{id}',[AuthController::class,'update']);
Route::get('/students/search/{name}',[AuthController::class,'search']);
Route::delete('/students/{id}',[AuthController::class,'delete']);
Route::post('/logout',[AuthController::class,'logout']);
});
 


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
