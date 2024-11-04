<?php

namespace App\Http\Controllers\MailMarketin;

use App\Http\Controllers\Controller;
use App\Models\Regras\CampanhaRepository;
use Illuminate\Http\Request;

class GatilhoEmailController extends Controller
{
    public function index()
    {
        #$campanhas = CampanhaRepository::getAll();
        return view('mail-marketing.gatilho.index');
    }
}
