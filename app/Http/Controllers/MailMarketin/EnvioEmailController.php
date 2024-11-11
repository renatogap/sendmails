<?php

namespace App\Http\Controllers\MailMarketin;

use App\Http\Controllers\Controller;
use App\Models\Regras\EnvioEmailLeadRegras;
use Exception;

class EnvioEmailController extends Controller
{
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
