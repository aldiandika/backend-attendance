<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\BaseController;

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

Route::post('login', [ApiController::class, 'authenticate']);
Route::post('register', [ApiController::class, 'register']);

Route::group(['middleware' => ['jwt.verify']], function(){
  Route::get('logout', [ApiController::class, 'logout']);
  Route::get('get-user', [ApiController::class, 'get_user']);
  Route::get('user-info', [BaseController::class, 'user_info']);
  Route::get('attend', [BaseController::class, 'attendance']);
  Route::get('attend-sum', [BaseController::class, 'attendSum']);
  Route::post('input-perm', [BaseController::class, 'permission']);
  Route::post('perm', [BaseController::class, 'get_all_perm']);
}

);