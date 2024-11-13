<?php

namespace App\Models\Regras;

use App\Models\Entity\Lead;
use Exception;

class LeadRegras
{
    public static function salvar($campanha, $email, $concordo, $nome = null, $telefone = null)
    {
        try {
            $lead = new Lead();
            $lead->campanha_id = $campanha;
            $lead->email = $email;
            $lead->concordo_termos = $concordo;
            $lead->status = 1;

            if(!empty($nome)) {
                $lead->nome = $nome;
            }

            if(!empty($telefone)) {
                $lead->telefone = $telefone;
            }

            $lead->save();

            return $lead;
        }
        catch(Exception $ex) {
            if(env('APP_DEBUG')) {
                throw new Exception('Erro ao salvar o Lead. '.$ex->getMessage());
            }else {
                throw new Exception('Erro ao salvar o Lead.');
            }
        }
    }
}
