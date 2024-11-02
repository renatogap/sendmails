<?php

namespace App\Models\Regras;

use App\Models\Entity\EnvioEmailLead;
use App\Models\Entity\GatilhoEmailTag;
use App\Models\Entity\LeadTag;
use App\Models\Entity\Tag;
use Carbon\Carbon;
use Exception;

class GatilhoEmailTagRegras
{
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

                    //EnvioEmailLeadRegras::enviarEmailObrigado($gatilho); // enviar o e-mail
                    
                    EnvioEmailLeadRegras::salvar($leadTag->lead_id, $tag->tag, $gatilho->id, $data); // salvar o envio de e-mail
                } 

                else if($gatilho->tipo_disparo == 'DATA') {

                    $dataEnvioEmail = Carbon::parse($gatilho->data_disparo);

                    // salvar o agendamento do envio em uma data específica
                    EnvioEmailLeadRegras::salvar($leadTag->lead_id, $tag->tag, $gatilho->id, $dataEnvioEmail);
                }
                
                else {
                    $dataEnvioEmail = Carbon::parse($leadTag->created_at);
                    $dataEnvioEmail = $dataEnvioEmail->addHour($gatilho->tempo_disparo);

                    EnvioEmailLeadRegras::salvar($leadTag->lead_id, $tag->tag, $gatilho->id, $dataEnvioEmail); // salvar o envio de e-mail
                    
                }

                // se a data ou o período configurado estiver concomitante com a data atual, então disparar o e-mails
                // if($data->greaterThanOrEqualTo($dataEnvioEmail)) {
                //     EnvioEmailLeadRegras::enviarEmailObrigado($gatilho);
                // }

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
