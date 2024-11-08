<?php

use App\Http\Controllers\MailMarketin\CampanhaController;
use App\Http\Controllers\MailMarketin\GatilhoEmailController;
use App\Http\Controllers\MailMarketin\IndexController;
use App\Http\Controllers\MailMarketin\TagController;
use App\Http\Controllers\MailMarketin\TemplateEmailController;
use App\Http\Controllers\MailMarketin\TipoGatilhoController;
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


Route::get('/', [IndexController::class, 'index']);

Route::get('campanhas', [CampanhaController::class, 'index']);
Route::get('campanha/create', [CampanhaController::class, 'create']);
Route::get('campanha/edit/{campanha}', [CampanhaController::class, 'edit']);
Route::post('campanha', [CampanhaController::class, 'store']);
Route::put('campanha/{campanha}', [CampanhaController::class, 'update']);
Route::get('campanhas/search', [CampanhaController::class, 'search']);
Route::get('campanha/info', [CampanhaController::class, 'info']);


Route::get('gatilhos', [GatilhoEmailController::class, 'index']);
Route::get('gatilho/create', [GatilhoEmailController::class, 'create']);
Route::get('gatilho/edit/{gatilho}', [GatilhoEmailController::class, 'edit']);
Route::post('gatilho', [GatilhoEmailController::class, 'store']);
Route::put('gatilho/{gatilho}', [GatilhoEmailController::class, 'update']);
Route::get('gatilhos/search', [GatilhoEmailController::class, 'search']);
Route::get('gatilho/info', [GatilhoEmailController::class, 'info']);

Route::get('tags', [TagController::class, 'index']);
Route::get('tags/search', [TagController::class, 'search']);
Route::get('tag/create', [TagController::class, 'create']);
Route::get('tag/edit/{tag}', [TagController::class, 'edit']);
Route::post('tag', [TagController::class, 'store']);
Route::put('tag/{tag}', [TagController::class, 'update']);

Route::get('templates', [TemplateEmailController::class, 'index']);
Route::get('templates/search', [TemplateEmailController::class, 'search']);
Route::get('template/create', [TemplateEmailController::class, 'create']);
Route::get('template/edit/{template}', [TemplateEmailController::class, 'edit']);
Route::post('template', [TemplateEmailController::class, 'store']);
Route::put('template/{template}', [TemplateEmailController::class, 'update']);

#Route::get('tags/list', [TagController::class, 'getAll']);
#Route::get('campanhas/list', [CampanhaController::class, 'index']);
#Route::get('tipos-gatilho/list', [TipoGatilhoController::class, 'index']);


Route::get('/inscricao/store', [CampanhaController::class, 'storeInscricaoLead']);