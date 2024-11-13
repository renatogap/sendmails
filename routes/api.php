<?php

use App\Http\Controllers\MailMarketin\EnvioEmailController;
use App\Http\Controllers\MailMarketin\InscricaoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/inscricao/store', [InscricaoController::class, 'store']);

Route::get('/envio-email/watch', [EnvioEmailController::class, 'watch']);
