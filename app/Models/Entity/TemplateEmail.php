<?php

namespace App\Models\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateEmail extends Model
{
    use HasFactory;

    protected $table = "template_email";

    protected $fillable = ['id', 'nome_template', 'assunto', 'descricao'];

}
