<?php

namespace App\Models\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class GatilhoEmailTag extends Model
{
    use HasFactory;

    protected $table = "gatilho_email_tag";

    protected $fillable = ['campanha_id', 'tag', 'tipo_disparo', 'data_disparo', 'tempo_disparo', 'repetir', 'assunto', 'mensagem'];

    public function campanha(): BelongsTo
    {
        return $this->belongsTo(Campanha::class);
    }

}
