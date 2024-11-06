<?php

namespace App\Models\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Campanha extends Model
{
    use HasFactory;

    protected $table = "campanha";

    protected $fillable = ['id', 'negocio_id', 'nome', 'versao', 'dt_inicio_campanha', 'dt_termino_campanha', 'meta_captura_leads', 'meta_leads_na_live', 'status'];


    public function negocio(): HasOne
    {
        return $this->HasOne(Negocio::class);
    }

    public function gatilhos()
    {
        return $this->hasMany(GatilhoEmailTag::class);
    }
}
