<?php

namespace App\Http\Controllers\MailMarketin;

use App\Models\Entity\Lead;
use App\Models\Entity\Tag;
use App\Models\Regras\EnvioEmailLeadRegras;
use App\Models\Regras\GatilhoEmailTagRegras;
use App\Models\Regras\LeadRegras;
use App\Models\Regras\LeadTagRegras;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class InscricaoController extends Controller
{
    public function store(Request $request)
    {
        $campanhaId = 1;
        $emailInscricao = 'renato.19gp@gmail.com';
        $tagInscricao = 'PROG10X_LS_#1';
        $concordo = 1;

        #EnvioEmailLeadRegras::agenda();

        /*
        $campanhaId = $request->campanha;
        $emailInscricao = $request->email;
        $concordo = $request->concordoTermo;
        */

        // verifica se o lead já se inscreveu no evento
        $isInscrito = Lead::where('campanha_id', $campanhaId)->where('email', $emailInscricao)->first();

        $tag = Tag::where('tag', $tagInscricao)->first();

        // bloqueia a tentativa de inscrição duplicada
        if($isInscrito) {
            
            EnvioEmailLeadRegras::enviarEmails();

            return response()->json(['message' => 'Ops, você já se inscreveu para este evento, te espero lá!']);
        }

        try {
            $lead = LeadRegras::salvar($campanhaId, $emailInscricao, $concordo);

            $leadTag = LeadTagRegras::salvar($tag, $lead);

            // disparar e-mail se o lead concordar com os termos
            if($concordo) {
                
                // registra os dados na tabela EnvioEmailLead p/ preparar para o(s) envio(s)
                GatilhoEmailTagRegras::disparar($campanhaId, $tag, $leadTag);

                // chamar o envio de e-mail para verificar os e-mails pendentes que já podem ser enviados
                EnvioEmailLeadRegras::enviarEmails();
                
            }

            dd('Redirecionando para a tela de obrigado...');

            //return redirect('Obrigado');
        }
        catch(Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 401);
        }        
    }
}
