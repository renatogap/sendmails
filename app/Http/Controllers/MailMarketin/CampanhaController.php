<?php

namespace App\Http\Controllers\MailMarketin;

use App\Models\Repository\CampanhaRepository;
use Exception;
use App\Http\Controllers\Controller;
use App\Http\Requests\CampanhaRequest;
use App\Models\Entity\Campanha;
use App\Models\Regras\CampanhaRegras;
use App\Models\Repository\NegocioRepository;

class CampanhaController extends Controller
{
    public function index()
    {
        return view('mail-marketing.campanha.index');
    }

    public function info()
    {
        return response()->json([
            'negocios' => NegocioRepository::getAll()
        ]);
    }

    public function search()
    {
        $campanhas = CampanhaRepository::getAll();
        return response()->json($campanhas);
    }

    public function create()
    {
        return view('mail-marketing.campanha.create');
    }

    public function store(CampanhaRequest $request)
    {
        $dadosValidados = $request->validated();

        try {
            // Usa o método salvar para criar o registro
            $campanha = CampanhaRegras::salvar((object) $dadosValidados);

            return response()->json([
                'message' => 'Campanha registrado com sucesso!',
                'campanha' => $campanha
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao tentar registrar a campanha de e-mail.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit(Campanha $campanha)
    {
        return view('mail-marketing.campanha.edit', compact('campanha'));
    }

    public function update(CampanhaRequest $request, Campanha $campanha)
    {
        $dadosForm = (object) $request->validated();

        try {
            
            // Usa o método salvar para criar o registro
            $campanha = CampanhaRegras::alterar($dadosForm, $campanha);

            return response()->json([
                'message' => 'Campanha alterado com sucesso!',
                'campanha' => $campanha
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao tentar alerar o campanha.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
}
