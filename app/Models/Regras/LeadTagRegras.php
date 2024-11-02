<?php

namespace App\Models\Regras;

use App\Models\Entity\Lead;
use App\Models\Entity\LeadTag;
use App\Models\Entity\Tag;
use Exception;

class LeadTagRegras
{
    public static function salvar(Tag $tag, Lead $lead)
    {
        try {
            $leadTag = new LeadTag();
            $leadTag->lead_id = $lead->id;
            $leadTag->tag = $tag->tag; //obtem a tag de inscrição
            $leadTag->save();

            return $leadTag;
        }
        catch(Exception $ex) {
            if(env('APP_DEBUG')) {
                throw new Exception('Erro ao salvar a tag do Lead. '.$ex->getMessage());
            }else {
                throw new Exception('Erro ao salvar a tag do Lead.');
            }
        }
    }
}
