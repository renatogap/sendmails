<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();

        return view('cliente.index', compact('clientes'));
    }

    public function cadastro()
    {
        return view('cliente.cadastro');
    }

    public function salvar(Request $request)
    {
        $novoCliente = new Cliente();
        $novoCliente->nome = $request->nome;
        $novoCliente->email = $request->email;
        $novoCliente->senha = $request->senha;
        $novoCliente->saldo = $request->saldo;
        $novoCliente->save();

        echo "Cliente cadastrado com sucesso!";
    }

    public function edicao($id)
    {
        $cliente = Cliente::find($id);

        return view('cliente.edicao', compact('cliente'));
    }

    public function alterar(Request $request)
    {
        $cliente = Cliente::find($request->id);
        $cliente->nome = $request->nome;
        $cliente->email = $request->email;
        $cliente->senha = $request->senha;
        $cliente->saldo = $request->saldo;
        $cliente->save();

        echo "Cliente alterado com sucesso!";
    }
}
