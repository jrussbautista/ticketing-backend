<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\Api\MeController;
use App\Http\Controllers\Api\TicketController;
use App\Http\Controllers\Api\TicketTypeController;
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


Route::post('login', LoginController::class);

Route::group(['middleware' => ['auth:sanctum']], function () {

    // Auth
    Route::get('me', MeController::class);
    Route::post('logout', LogoutController::class);

    // Tickets
    Route::apiResource('tickets', TicketController::class);

    // Ticket Types
    Route::apiResource('types', TicketTypeController::class);
    


});
