<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\Request;

class FornecedoresController extends Controller
{
    /**
     * Exibir a lista de fornecedores.
     */
    public function index()
    {
        $fornecedores = Fornecedor::all();
        return view('fornecedores.index', compact('fornecedores'));
    }

    /**
     * Mostrar o formulário para criar um novo fornecedor.
     */
    public function create()
    {
        return view('fornecedores.create');
    }

    /**
     * Armazenar um novo fornecedor no banco de dados.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'empresa' => 'required|string|max:255',
            'vendedor' => 'required|string|max:255',
            'cnpj' => 'required|string|max:18|unique:fornecedores,cnpj',
            'endereco' => 'required|string|max:255',
            'telefone' => 'nullable|string|max:15',
            'email' => 'required|email',
            'formapg' => 'nullable|string',
            'data' => 'required|date',
        ]);

        Fornecedor::create($validatedData);
        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor cadastrado com sucesso!');
    }

    /**
     * Mostrar o formulário para editar um fornecedor existente.
     */
    public function edit($id)
    {
        $fornecedor = Fornecedor::findOrFail($id);
        return view('fornecedores.edit', compact('fornecedor'));
    }

    /**
     * Atualizar os dados de um fornecedor.
     */
    public function update(Request $request, $id)
    {
        $fornecedor = Fornecedor::findOrFail($id);

        $validatedData = $request->validate([
            'empresa' => 'required|string|max:255',
            'vendedor' => 'required|string|max:255',
            'cnpj' => 'required|string|max:18|unique:fornecedores,cnpj,'.$fornecedor->id,
            'endereco' => 'required|string|max:255',
            'telefone' => 'nullable|string|max:15',
            'email' => 'required|email',
            'formapg' => 'nullable|string',
            'data' => 'required|date',
        ]);

        $fornecedor->update($validatedData);
        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor atualizado com sucesso!');
    }

    /**
     * Remover um fornecedor do banco de dados.
     */
    public function destroy($id)
    {
        $fornecedor = Fornecedor::findOrFail($id);
        $fornecedor->delete();
        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor excluído com sucesso!');
    }
}
