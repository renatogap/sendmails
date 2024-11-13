<?php

namespace App\Models\Repository;

use App\Models\Entity\EnvioEmailLead;
use Illuminate\Support\Facades\DB;

class EnvioEmailLeadRepository
{
    public static function getAll()
    {
        return DB::table('envio_email_lead as e')
                ->join('gatilho_email_tag as g', 'e.gatilho_email_tag_id', '=', 'g.id')
                ->join('lead as l', 'e.lead_id', '=', 'l.id')
                ->join('campanha as c', 'g.campanha_id', '=', 'c.id')
                ->join('negocio as n', 'c.negocio_id', '=', 'n.id')
                ->select([
                    'n.nome_metodo as negocio',
                    'c.nome as campanha',
                    'g.tag',
                    'g.nome as descricao_gatilho',
                    'c.versao',
                    'l.nome as nome_lead',
                    'l.email',
                    'g.tipo_disparo',
                    'g.tempo_disparo',
                    DB::raw("DATE_FORMAT(g.data_disparo, '%d/%m/%Y %H:%i') as data_disparo"),
                    DB::raw("DATE_FORMAT(e.data_envio, '%d/%m/%Y %H:%i') as data_envio"),
                    DB::raw("CASE WHEN e.enviado = 1
                                THEN '<span class=\"badge text-bg-primary\"> Enviado </span>'
                                ELSE '<span class=\"badge text-bg-warning\"> Programado </span>'
                            END AS status_envio"),
                    'e.created_at'
                ])
                ->get();
    }

    public static function find($id)
    {
        return EnvioEmailLead::find($id);
    }

}
