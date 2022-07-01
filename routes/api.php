<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController1;
use App\Http\Controllers\VehiculeController;
use App\Http\Controllers\ReclamationController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\agentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

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
Route::POST('/admin' , [RegisterController1::class ,'asynrole']);
Route::POST('/login' , [LoginController::class ,'Login']);
Route::Get('/afficherVehicule' , [VehiculeController::class ,'index']);

Route::Get('/afficherUsers' , [UserController::class ,'index']);
Route::DELETE('/DeleteUser/{id}' , [UserController::class ,'DeleteUser']);




Route::middleware('auth:sanctum')->group(function () {
Route::post('CreateAgent',[agentController::class,'CreateAgent']);
Route::GET('ShowAgent',[agentController::class,'index']);




Route::post('/CreateAdmin',[AdminController::class,'CreateAdmin']);
Route::GET('/ShowAdmin',[AdminController::class,'index']);
Route::delete('/deleteadmin/{id}',[AdminController::class,'DeleteAdmin']);
Route::GET('/Show1Admin/{id}',[AdminController::class,'index1']);
Route::GET('/updateAdmin/{id}',[AdminController::class,'UpdateAdmin']);
// user reclam

Route::Get('/afficherReclamationUser' , [ReclamationController::class ,'index_user']);
//admin reclam

Route::Get('/afficherReclamation' , [ReclamationController::class ,'index']);

//user reserv
Route::Get('/user_reservation' , [ReservationController::class ,'user_reservation']);

//admin reserv
Route::Get('/afficherReservation' , [ReservationController::class ,'index']);

//delete reservation
Route::delete('/DeleteReservation/{id}',[ReservationController::class,'DeleteReservation']);

Route::POST('/AddReclamation',[ReclamationController::class,'addReclamation']);
Route::PUT('/UpdateReclamation/{id}',[ReclamationController::class,'UpdateReclamation']);
Route::delete('/DeleteReclamation/{id}',[ReclamationController::class,'DeleteReclamation']);

});




Route::Get('/afficherVehicule' , [VehiculeController::class ,'index']);
Route::POST('Addvehicule', [VehiculeController::class,'CreateVehicule']);
Route::put('Updatevehicule/{id}', [VehiculeController::class,'UpdateVehicule']);
Route::delete('Deletevehicule/{id}', [VehiculeController::class,'DeleteVehicule']);





// Route::Get('/afficherReclamation' , [ReclamationController::class ,'index']);
Route::POST('AddReservation', [ReservationController::class,'AddReservation']);
Route::delete('DeleteReservation',[ReservationController::class,'AddReservation']);
Route::put('UpdateReservation',[ReservationController::class,'UpdateReservation']);


//Route::post('CreatAgent',[agentController::class,'CreateAgent']);


