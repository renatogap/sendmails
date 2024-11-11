<?php

namespace App\Models\Regras;

use App\Mail\ObrigadoMail;
use App\Models\Entity\EnvioEmailLead;
use App\Models\Entity\GatilhoEmailTag;
use App\Models\Entity\Lead;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Mail;

class EnvioEmailLeadRegras
{
    /**
     * Obtem todos os registros pendentes prontos para o envio de e-mail
     */
    public static function rotinaDeEnvio()
    {
        try {
            $emailsPendentesVencidosProntosParaEnvio = self::emailsPendentesVencidosProntosParaEnvio();

            if(!$emailsPendentesVencidosProntosParaEnvio->isEmpty()) {

                foreach($emailsPendentesVencidosProntosParaEnvio as $emailPendenteVencido) {
                    $gatilho = GatilhoEmailTag::find($emailPendenteVencido->gatilho_email_tag_id);
                    $lead = Lead::find($emailPendenteVencido->lead_id);
                    self::enviarEmail($lead, $gatilho);
                    self::atualizarDadosDoEnvio($emailPendenteVencido);
                }
            }
        }
        catch(Exception $ex) {
            if(env('APP_DEBUG')) {
                throw new Exception('Erro ao enviar os e-mails pendentes. '.$ex->getMessage());
            }else {
                throw new Exception('Erro ao enviar os e-mails pendentes');
            }
        }
    }

    public static function enviarEmail(Lead $lead, GatilhoEmailTag $gatilho)
    {
        try {
            Mail::to($lead->email)->send( new ObrigadoMail($gatilho));
        }
        catch(Exception $ex) {
            if(env('APP_DEBUG')) {
                throw new Exception('Erro ao enviar o e-mail ao Lead. '.$ex->getMessage());
            }else {
                throw new Exception('Erro ao enviar o e-mail o Lead.');
            }
        }    
    }
    
    public static function salvar($lead_id, $tag, $gatilho_id, Carbon $dtEnvio, $enviado = false)
    {
        try {
            $envioEmailLead = new EnvioEmailLead();
            $envioEmailLead->lead_id = $lead_id;
            $envioEmailLead->gatilho_email_tag_id = $gatilho_id;
            $envioEmailLead->tag = $tag;
            $envioEmailLead->data_envio = $dtEnvio->format('Y-m-d H:i:s');
            $envioEmailLead->enviado = $enviado;
            $envioEmailLead->save();

            return $envioEmailLead;
        }
        catch(Exception $ex) {
            if(env('APP_DEBUG')) {
                throw new Exception('Erro ao salvar o envio do e-mail ao Lead. '.$ex->getMessage());
            }else {
                throw new Exception('Erro ao salvar o envio do e-mail ao Lead.');
            }
        }
    }

    public static function atualizarDadosDoEnvio(EnvioEmailLead $envio)
    {
        try {
            $envioEmailLead = EnvioEmailLead::find($envio->id);
            $envioEmailLead->enviado = true;
            $envioEmailLead->save();

            return $envioEmailLead;
        }
        catch(Exception $ex) {
            if(env('APP_DEBUG')) {
                throw new Exception('Erro ao atualizar o envio do e-mail ao Lead. '.$ex->getMessage());
            }else {
                throw new Exception('Erro ao atualizar o envio do e-mail ao Lead.');
            }
        }    
    }

    public static function emailsPendentesVencidosProntosParaEnvio()
    {
        $dataCorrente = Carbon::now();
        $emailsPendentes = EnvioEmailLead::where('enviado', false)->where('data_envio', '<=', $dataCorrente->format('Y-m-d H:i:s'))->get();

        return $emailsPendentes;
    }

}
