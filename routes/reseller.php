<?php

use App\Http\Controllers\Reseller\AuthController;
use App\Http\Controllers\Reseller\ResellerAuthController;
use Illuminate\Support\Facades\Route;

Route::group(['as'=> 'reseller.', 'prefix'=> 'reseller', 'middleware'=> []], function(){

  // reseller auth controller
  // Route::get('/', [AuthController::class,'index'])->name('index');
  Route::match(['POST', 'GET'], '/register', [AuthController::class, 'register'])->name('register');
  Route::match(['POST', 'GET'], '/login', [AuthController::class, 'login'])->name('login');

  // Route::get('/test', function(){
  //   return 'Hi, I am from reseller routes!';
  // })->name('register');
});


// require __DIR__ . 'auth.php';
