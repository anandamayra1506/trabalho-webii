<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes', compact('clientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'endereco' => 'required',
            'telefone' => 'required',
            'email' => 'required|email',
            'cpf' => 'required|unique:clientes,cpf',
        ]);

        Cliente::create($request->all());
        return redirect()->route('clientes.index')->with('success', 'Cliente cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        $clientes = Cliente::all();
        return view('clientes', compact('cliente', 'clientes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required',
            'endereco' => 'required',
            'telefone' => 'required',
            'email' => 'required|email',
            'cpf' => 'required|unique:clientes,cpf,'.$id,
        ]);

        $cliente = Cliente::findOrFail($id);
        $cliente->update($request->all());
        return redirect()->route('clientes.index')->with('success', 'Cliente atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente excluído com sucesso!');
    }
}
