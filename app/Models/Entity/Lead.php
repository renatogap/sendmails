<?php

namespace App\Models\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lead extends Model
{
    use HasFactory;

    protected $table = "lead";

    protected $fillable = ['id', 'campanha_id', 'nome', 'email', 'telefone', 'concordo_termos', 'created_at'];

    public function campanha(): BelongsTo
    {
        return $this->belongsTo(Campanha::class);
    }

    public function leadTags(): HasMany
    {
        return $this->hasMany(LeadTag::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return $value ? \Carbon\Carbon::parse($value)->format('d/m/Y H:i') : null;
    }
}
