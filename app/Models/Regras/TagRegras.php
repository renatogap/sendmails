<?php

namespace App\Models\Regras;

use App\Models\Entity\GatilhoEmailTag;
use App\Models\Entity\LeadTag;
use App\Models\Entity\Tag;
use App\Models\Repository\TagRepository;
use Carbon\Carbon;
use Exception;

class TagRegras
{
    public static function salvar($dados)
    {
        return TagRepository::create([
            'tag' => $dados->tag,
            'nome' => $dados->nome
        ]);
    }

    public static function alterar(Object $dados, Tag $tag)
    {
        return TagRepository::update($tag->id, [
            'tag' => $dados->tag,
            'nome' => $dados->nome
        ]);
    }

}
