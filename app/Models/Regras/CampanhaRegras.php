<?php

namespace App\Models\Regras;

use App\Models\Entity\Campanha;
use App\Models\Entity\GatilhoEmailTag;
use App\Models\Entity\LeadTag;
use App\Models\Entity\Tag;
use App\Models\Repository\CampanhaRepository;
use Carbon\Carbon;
use Exception;

class CampanhaRegras
{
    public static function salvar($dados)
    {
        return CampanhaRepository::create([
            'negocio_id' => $dados->negocio,
            'nome' => $dados->campanha,
            'versao' => $dados->versao,
            'dt_inicio_campanha' => $dados->dataInicioCampanha,
            'dt_termino_campanha' => $dados->dataTerminoCampanha,
            'meta_captura_leads' => $dados->metaLeads,
            'meta_leads_na_live' => $dados->metaLeadsLive,
            'status' => 1
        ]);
    }

    public static function alterar(Object $dados, Campanha $campanha)
    {
        return CampanhaRepository::update($campanha->id, [
            'negocio_id' => $dados->negocio,
            'nome' => $dados->campanha,
            'versao' => $dados->versao,
            'dt_inicio_campanha' => $dados->dataInicioCampanha,
            'dt_termino_campanha' => $dados->dataTerminoCampanha,
            'meta_captura_leads' => $dados->metaLeads,
            'meta_leads_na_live' => $dados->metaLeadsLive,
            'status' => 1
        ]);
    }




    /**
     * Essa função verifica se há gatilhos para a tag informada. Caso positivo, ela verifica qual o tipo de disparo
     * de e-mail (IMEDIATAMENTE, DATA_EXATA ou TEMPO), faz o calculo para obter a data exata em que o e-mail deve
     * ser enviado e grava na tabela EnvioEmailLead, para deixar preparado para a classe de EnvioEmail disparar os
     * e-mails se a data_envio concomitar com a data corrente.
     */
    public static function disparar($campanha, Tag $tag, LeadTag $leadTag)
    {
        try {
            $gatilhos = GatilhoEmailTag::where('campanha_id', $campanha)->where('tag', $tag->tag)->get();

            if($gatilhos->isEmpty()){
                throw new Exception('Não há nenhum gatilho configurado para a tag '.$tag->tag.'.');
            }
                
            $data = Carbon::now();
            
            foreach($gatilhos as $gatilho) {

                if($gatilho->tipo_disparo == 'IMEDIATAMENTE') {
                    EnvioEmailLeadRegras::salvar($leadTag->lead_id, $tag->tag, $gatilho->id, $data); // salvar o envio de e-mail
                } 
                else if($gatilho->tipo_disparo == 'DATA') {
                    $dataEnvioEmail = Carbon::parse($gatilho->data_disparo);

                    EnvioEmailLeadRegras::salvar($leadTag->lead_id, $tag->tag, $gatilho->id, $dataEnvioEmail);
                }
                else {
                    $dataEnvioEmail = Carbon::parse($leadTag->created_at);
                    $dataEnvioEmail = $dataEnvioEmail->addHour($gatilho->tempo_disparo);

                    EnvioEmailLeadRegras::salvar($leadTag->lead_id, $tag->tag, $gatilho->id, $dataEnvioEmail); // salvar o envio de e-mail
                }
            }

        }
        catch(Exception $ex) {
            if(env('APP_DEBUG')) {
                throw new Exception('Erro ao enviar o gatilho de e-mail. '.$ex->getMessage());
            }else {
                throw new Exception('Erro ao enviar o gatilho de e-mail');
            }
        }
    }

}
