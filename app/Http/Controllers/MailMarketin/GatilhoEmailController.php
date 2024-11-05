<?php

namespace App\Http\Controllers\MailMarketin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GatilhoRequest;
use App\Models\Entity\GatilhoEmailTag;
use App\Models\Regras\GatilhoEmailTagRegras;
use Exception;
use Illuminate\Http\Request;

class GatilhoEmailController extends Controller
{
    public function index()
    {
        return view('mail-marketing.gatilho.index');
    }

    public function search()
    {
        $gatilhos = GatilhoEmailTag::with('campanha')->orderBy('id')->get();
        return response()->json($gatilhos);
    }

    public function create()
    {
        return view('mail-marketing.gatilho.create');
    }

    public function store(GatilhoRequest $request)
    {
        $dadosValidados = $request->validated();

        try {
            // Usa o método salvar para criar o registro
            $gatilho = GatilhoEmailTagRegras::salvar((object) $dadosValidados);

            return response()->json([
                'message' => 'Gatilho de e-mail salvo com sucesso!',
                'data' => $gatilho
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao salvar o gatilho de e-mail.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
