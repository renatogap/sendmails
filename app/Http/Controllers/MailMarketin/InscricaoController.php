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
    public function store()
    {   
        $campanhaId = request()->input('campanha');
        $tagInscricao = request()->input('tag');
        $emailInscricao = request()->input('email');
        $concordo = request()->input('concordo');
        $nome = request()->input('nome', null);
        $telefone = request()->input('telefone', null);
        

        // verifica se o lead já se inscreveu no evento
        $isInscrito = Lead::where('campanha_id', $campanhaId)->where('email', $emailInscricao)->first();

        // bloqueia a tentativa de inscrição duplicada
        if($isInscrito) {
            
            //EnvioEmailLeadRegras::watchEmailsPendentes();

            return response()->json(['error' => 'Fala Dev! Você já se inscreveu para esse evento, te espero lá!'], 401);
        }

        try {
            $tag = Tag::where('tag', $tagInscricao)->first();

            $lead = LeadRegras::salvar($campanhaId, $emailInscricao, $concordo, $nome, $telefone);

            $leadTag = LeadTagRegras::salvar($tag, $lead);

            // disparar e-mail se o lead concordar com os termos
            if($concordo) {
                
                // registra os dados na tabela EnvioEmailLead p/ preparar para o(s) envio(s)
                GatilhoEmailTagRegras::disparar($campanhaId, $tag, $leadTag);
                
                // chamar o envio de e-mail para verificar os e-mails pendentes que já podem ser enviados
                //EnvioEmailLeadRegras::watchEmailsPendentes();
                
            }

            return response()->json(['message' => 'Tudo Ok!'], 200);

            //return redirect('Obrigado');
        }
        catch(Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 401);
        }        
    }
}
