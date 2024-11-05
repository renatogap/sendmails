<?php

namespace App\Http\Controllers\MailMarketin;

use App\Http\Controllers\Controller;
use App\Models\Repository\TipoGatilhoRepository;
use Illuminate\Http\Request;

class TipoGatilhoController extends Controller
{
    public function index()
    {
        $tiposGatilho = TipoGatilhoRepository::getAll();

        return response()->json($tiposGatilho);
    }
}
