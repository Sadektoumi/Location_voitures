<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController1;
use App\Http\Controllers\VehiculeController;
use App\Http\Controllers\ReclamationController;
use App\Http\Controllers\ReservationController;

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
Route::POST('/register' , [RegisterController1::class ,'Register']);
Route::POST('/login' , [LoginController::class ,'Login']);

Route::middleware('auth:sanctum')->get('/profile', function (Request $request) {


    return 'done';

});

Route::POST('Addvehicule', [VehiculeController::class,'CreateVehicule']);
Route::post('Updatevehicule/{id}', [VehiculeController::class,'UpdateVehicule']);
Route::delete('Deletevehicule/{id}', [VehiculeController::class,'DeleteVehicule']);
Route::POST('AddReclamation',[ReclamationController::class,'addReclamation']);
Route::PUT('UpdateReclamation/{id}',[ReclamationController::class,'UpdateReclamation']);
Route::delete('DeleteReclamation/{id}',[ReclamationController::class,'DeleteReclamation']);
Route::POST('AddReservation', [ReservationController::class,'AddReservation']);
Route::delete('DeleteReservation',[ReservationController::class,'AddReservation']);
Route::put('UpdateReservation',[ReservationController::class,'UpdateReservation']);
