<?php

use App\Http\Controllers\CampanhaController;
use App\Http\Controllers\ClienteController;
use App\Mail\SendMailLead;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
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
    $dados = (object) [
        'nome' => 'ALINE FONSE PEREIRA',
        'email' => 'aline.fonseca01@gmail.com'
    ];

    $data = Carbon::now();

    dd($data->addHour(5));

    Mail::to(env('MAIL_FROM_ADDRESS'))->send( new SendMailLead($dados));
    return view('welcome');
});

Route::get('/inscricao/store', [CampanhaController::class, 'storeInscricaoLead']);

Route::get('/cliente', [ClienteController::class, 'index']);
Route::get('/cliente/cadastro', [ClienteController::class, 'cadastro']);
Route::post('/cliente/salvar', [ClienteController::class, 'salvar']);
Route::get('/cliente/edicao/{id}', [ClienteController::class, 'edicao']);
Route::post('/cliente/alterar', [ClienteController::class, 'alterar']);
