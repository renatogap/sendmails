<?php

use App\Http\Controllers\CampanhaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\MailMarketin\GatilhoEmailController;
use App\Http\Controllers\MailMarketin\TagController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('gatilhos', [GatilhoEmailController::class, 'index']);
Route::get('gatilho/create', [GatilhoEmailController::class, 'create']);
Route::get('gatilho/edit/{id}', [GatilhoEmailController::class, 'edit']);
Route::post('gatilho', [GatilhoEmailController::class, 'store']);
Route::put('gatilho', [GatilhoEmailController::class, 'update']);

Route::get('tags', [TagController::class, 'index']);
Route::get('tag/create', [TagController::class, 'create']);
Route::get('tag/edit/{id}', [TagController::class, 'edit']);
Route::post('tag', [TagController::class, 'store']);
Route::put('tag', [TagController::class, 'update']);

Route::get('campanhas', [CampanhaController::class, 'index']);


Route::get('/inscricao/store', [CampanhaController::class, 'storeInscricaoLead']);