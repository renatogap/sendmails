<?php

namespace App\Http\Controllers;

use App\Models\Entity\Lead;
use App\Models\Entity\Tag;
use App\Models\Regras\EnvioEmailLeadRegras;
use App\Models\Regras\GatilhoEmailTagRegras;
use App\Models\Regras\LeadRegras;
use App\Models\Regras\LeadTagRegras;
use App\Models\Repository\CampanhaRepository;
use Exception;
use Illuminate\Http\Request;

class CampanhaController extends Controller
{
    public function index()
    {
        $campanhas = CampanhaRepository::getAll();

        return response()->json($campanhas);
    }

    public function storeInscricaoLead(Request $request)
    {
        $campanha_id = 1;
        $email = 'renato.19gp@gmail.com';
        $concordo = 1;

        #EnvioEmailLeadRegras::agenda();

        /*
        $campanha_id = $request->campanha;
        $email = $request->email;
        $concordo = $request->concordoTermo;
        */

        // verifica se o lead já se inscreveu no evento
        $isInscrito = Lead::where('campanha_id', $campanha_id)->where('email', $email)->first();

        $tag = Tag::where('nome', '[LAUNCH][OBRIGADO]')->first();

        // bloqueia a tentativa de inscrição duplicada
        if($isInscrito) {
            
            EnvioEmailLeadRegras::enviarEmails();

            return response()->json(['message' => 'Ops, você já se inscreveu para este evento, te espero lá!']);
        }

        try {
            $lead = LeadRegras::salvar($campanha_id, $email, $concordo);

            $leadTag = LeadTagRegras::salvar($tag, $lead);

            // disparar e-mail se o lead concordar com os termos
            if($concordo) {
                
                // registra os dados na tabela EnvioEmailLead p/ preparar para o(s) envio(s)
                GatilhoEmailTagRegras::disparar($campanha_id, $tag, $leadTag);

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
