<?php

namespace App\Http\Controllers\MailMarketin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TemplateEmailRequest;
use App\Models\Entity\TemplateEmail;
use App\Models\Regras\TemplateEmailRegras;
use Exception;
use Illuminate\Http\Request;

class TemplateEmailController extends Controller
{
    public function index()
    {
        return view('mail-marketing.template-email.index');
    }

    public function search()
    {
        $templates = TemplateEmail::orderBy('id')->get();
        return response()->json($templates);
    }

    public function create()
    {
        return view('mail-marketing.template-email.create');
    }

    public function store(TemplateEmailRequest $request)
    {
        $dadosValidados = $request->validated();

        try {
            // Usa o método salvar para criar o registro
            $template = TemplateEmailRegras::salvar((object) $dadosValidados);

            return response()->json([
                'message' => 'Template registrado com sucesso!',
                'template' => $template
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao tentar registrar o template.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit(TemplateEmail $template)
    {
        return view('mail-marketing.template-email.edit', compact('template'));
    }

    public function update(TemplateEmailRequest $request, TemplateEmail $template)
    {
        $dadosForm = (object) $request->validated();

        try {
            
            // Usa o método salvar para criar o registro
            $template = TemplateEmailRegras::alterar($dadosForm, $template);

            return response()->json([
                'message' => 'Template alterado com sucesso!',
                'template' => $template
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao tentar alerar o template.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
