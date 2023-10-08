<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProfilePhotoController;
 

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register',function(){
    return view('register');
});

Route::get('/login',function(){
    return view('login');
});

Route::get('/forget',function(){
    return view('forget');
});

Route::get('/createnewpassword',function(){
    return view('createnewpassword');
});

Route::get('/edit',function(){
    return view('edit');
});

Route::get('/employees',function(){
    return view('employees');
});

Route::get('/contact',function(){
    return view('contact');
});

Route::get('/upload',function(){
    return view('upload');
});

//controller classes
Route::get('/',[QuestionsController::class,'getresponses']);

Route::get('/user/verify/{token}',[UsersController::class,'verify']);
Route::post('/login',[UsersController::class,'login']);
Route::get('/account',[UsersController::class,'loggedin']);
Route::get('/logout',[UsersController::class,'logout']);
Route::get('/edit/{id}',[UsersController::class,'edit']);
Route::post('/edit',[UsersController::class,'saveupdate']);
Route::post('/forget',[UsersController::class,'forgetPassword']);
Route::post('/createnewpassword',[UsersController::class,'createnewpassword']);
Route::get('/delete',[UsersController::class,'deleteuser']);
Route::get('/logout',[UsersController::class,'logout']);


Route::post('/upload',[ProfilePhotoController::class,'uploadprofilephoto']);