<?php

namespace App\Models\Regras;

use App\Mail\ObrigadoMail;
use App\Models\Entity\EnvioEmailLead;
use App\Models\Entity\GatilhoEmailTag;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Mail;

class EnvioEmailLeadRegras
{
    public static function enviarEmails()
    {
        try {

            // obtem os e-mails programados que ainda não foram enviados
            $emailsPendentesVencidosProntosParaEnvio = EnvioEmailLeadRegras::emailsPendentesVencidosProntosParaEnvio();

            if(!$emailsPendentesVencidosProntosParaEnvio->isEmpty()) {

                foreach($emailsPendentesVencidosProntosParaEnvio as $emailPendenteVencido) {

                    $gatilho = GatilhoEmailTag::find($emailPendenteVencido->gatilho_email_tag_id);

                    EnvioEmailLeadRegras::enviarEmail($gatilho);

                    EnvioEmailLeadRegras::atualizarEnvio($emailPendenteVencido);
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

    public static function enviarEmail(GatilhoEmailTag $gatilho)
    {
        try {
            Mail::to(env('MAIL_FROM_ADDRESS'))->send( new ObrigadoMail($gatilho));
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

    public static function atualizarEnvio(EnvioEmailLead $envio)
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
