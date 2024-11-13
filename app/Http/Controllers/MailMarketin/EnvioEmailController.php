<?php

namespace App\Http\Controllers\MailMarketin;

use App\Http\Controllers\Controller;
use App\Models\Regras\EnvioEmailLeadRegras;
use App\Models\Repository\EnvioEmailLeadRepository;
use Exception;

class EnvioEmailController extends Controller
{
    public function index()
    {
        return view('mail-marketing.envio.index');
    }

    public function search()
    {
        $enviados = EnvioEmailLeadRepository::getAll();
        return response()->json($enviados);
    }

    public function watch()
    {
        try {
            EnvioEmailLeadRegras::rotinaDeEnvio();

            return response()->json(['message' => 'Rotina disparada em '.date('d/m/Y H:i:s')], 200);
        }
        catch(Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 401);
        }
    }
}
