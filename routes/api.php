<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\EmployeesController;




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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login',[LoginController::class,'login']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');


Route::middleware(['auth:sanctum'])->group(function () {
    Route::group(['prefix' => 'companies'], function () {
        Route::get('/index',[CompaniesController::class,'index']);
        Route::post('/create',[CompaniesController::class,'create']);
        Route::get('/edit/{id}',[CompaniesController::class,'edit']);
        Route::post('/update/{id}',[CompaniesController::class,'update']);
        Route::delete('/delete/{id}',[CompaniesController::class,'destroy']);

    });

    Route::group(['prefix' => 'employees'], function () {
        Route::get('/index',[EmployeesController::class,'index']);
        Route::post('/create',[EmployeesController::class,'create']);
        Route::get('/edit/{id}',[EmployeesController::class,'edit']);
        Route::post('/update/{id}',[EmployeesController::class,'update']);
        Route::delete('/delete/{id}',[EmployeesController::class,'destroy']);

    });

});
