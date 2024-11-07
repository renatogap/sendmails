<?php

namespace App\Http\Controllers\MailMarketin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use App\Models\Entity\Tag;
use App\Models\Regras\TagRegras;
use App\Models\Repository\TagRepository;
use Exception;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        return view('mail-marketing.tag.index');
    }

    // public function getAll()
    // {
    //     $tags = TagRepository::getAll();
    //     return response()->json($tags);
    // }

    // public function info()
    // {
    //     $tags = TagRepository::getAll();
    //     return response()->json($tags);
    // }

    public function search()
    {
        $tags = Tag::orderBy('id')->get();
        return response()->json($tags);
    }

    public function create()
    {
        return view('mail-marketing.tag.create');
    }

    public function store(TagRequest $request)
    {
        $dadosValidados = $request->validated();

        try {
            // Usa o método salvar para criar o registro
            $tag = TagRegras::salvar((object) $dadosValidados);

            return response()->json([
                'message' => 'Tag registrada com sucesso!',
                'tag' => $tag
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao tentar registrar a tag.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit(Tag $tag)
    {
        return view('mail-marketing.tag.edit', compact('tag'));
    }

    public function update(TagRequest $request, Tag $tag)
    {
        $dadosForm = (object) $request->validated();

        try {
            
            // Usa o método salvar para criar o registro
            $tag = TagRegras::alterar($dadosForm, $tag);

            return response()->json([
                'message' => 'Tag alterada com sucesso!',
                'tag' => $tag
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erro ao tentar alerar a tag de e-mail.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
