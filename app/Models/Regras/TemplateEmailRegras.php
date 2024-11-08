<?php

namespace App\Models\Regras;

use App\Models\Entity\TemplateEmail;
use App\Models\Repository\TemplateEmailRepository;

class TemplateEmailRegras
{
    public static function salvar($dados)
    {
        return TemplateEmailRepository::create([
            'nome_template' => $dados->nome,
            'assunto' => $dados->assunto,
            'descricao' => $dados->descricao
        ]);
    }

    public static function alterar(Object $dados, TemplateEmail $template)
    {
        return TemplateEmailRepository::update($template->id, [
            'nome_template' => $dados->nome,
            'assunto' => $dados->assunto,
            'descricao' => $dados->descricao
        ]);
    }

}
