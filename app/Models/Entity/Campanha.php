<?php

namespace App\Models\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Campanha extends Model
{
    use HasFactory;

    protected $table = "campanha";

    protected Campanha $campanha;


    public function negocio(): HasOne
    {
        return $this->HasOne(Negocio::class, 'negocio_id', 'id');
    }


}
