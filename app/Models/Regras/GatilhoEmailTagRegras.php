<?php

namespace App\Models\Regras;

use App\Models\Entity\GatilhoEmailTag;
use App\Models\Entity\LeadTag;
use App\Models\Entity\Tag;
use Carbon\Carbon;
use Exception;

class GatilhoEmailTagRegras
{
    public static function salvar($dados)
    {
        return GatilhoEmailTag::create([
            'campanha_id' => $dados->campanha,
            'tag' => $dados->tag,
            'tipo_disparo' => $dados->tipoGatilho,
            'data_disparo' => $dados->dataGatilho ?? null,
            'tempo_disparo' => $dados->tempoGatilho ?? null,
            'repetir' => $dados->repetir ?? null,
            'assunto' => $dados->assunto,
            'mensagem' => $dados->mensagem,
        ]);
    }

    public static function alterar(Object $dados, GatilhoEmailTag $gatilho)
    {
        return $gatilho->update([
            'campanha_id' => $dados->campanha,
            'tag' => $dados->tag,
            'tipo_disparo' => $dados->tipoGatilho,
            'data_disparo' => $dados->dataGatilho ?? null,
            'tempo_disparo' => $dados->tempoGatilho ?? null,
            'repetir' => $dados->repetir ?? null,
            'assunto' => $dados->assunto,
            'mensagem' => $dados->mensagem,
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
            
            foreach($gatilhos as $gatilho) {
                $dataEnvioEmail = GatilhoEmailTagRegras::calculaDataDeEnvio($gatilho, $leadTag->created_at);
                EnvioEmailLeadRegras::salvar($leadTag->lead_id, $tag->tag, $gatilho->id, $dataEnvioEmail);
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


    public static function calculaDataDeEnvio(GatilhoEmailTag $gatilho, $dataInscricao)
    {
        if($gatilho->tipo_disparo == 'IMEDIATAMENTE') {
            $dataEnvioEmail = Carbon::now();
        } 
        else if($gatilho->tipo_disparo == 'DATA') {
            $dataEnvioEmail = Carbon::parse($gatilho->data_disparo);
        }
        else if($gatilho->tipo_disparo == 'DIA(S)') {
            $dataEnvioEmail = Carbon::parse($dataInscricao);
            $dataEnvioEmail = $dataEnvioEmail->addDays($gatilho->tempo_disparo);
        }
        else if($gatilho->tipo_disparo == 'SEMANA(S)') {
            $dataEnvioEmail = Carbon::parse($dataInscricao);
            $tempoDisparo = ($gatilho->tempo_disparo * 7);
            $dataEnvioEmail = $dataEnvioEmail->addDays($tempoDisparo);
        }
        else if($gatilho->tipo_disparo == 'HORA(S)') {
            $dataEnvioEmail = Carbon::parse($dataInscricao);
            $dataEnvioEmail = $dataEnvioEmail->addHour($gatilho->tempo_disparo);
        }
        else if($gatilho->tipo_disparo == 'SEGUNDO(S)') {
            $dataEnvioEmail = Carbon::parse($dataInscricao);
            $dataEnvioEmail = $dataEnvioEmail->addSeconds($gatilho->tempo_disparo);
        }

        return $dataEnvioEmail;
    }

}
