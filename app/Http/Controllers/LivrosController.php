<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use Illuminate\Http\Request;

class LivrosController extends Controller
{
    public function index()
    {
        $livros = Livro::all();
        dd($livros); 
        return view('livros.index', compact('livros'));
    }
    


    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'autor' => 'required',
            'isbn' => 'required|unique:livros',
            'editora' => 'required',
            'ano' => 'required|integer',
            'preco' => 'required|numeric',
            'quantidade' => 'required|integer|min:1',
            'genero' => 'required|string',
        ]);

        Livro::create($request->all());
        return redirect()->route('livros.index')->with('success', 'Livro cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $livro = Livro::findOrFail($id);
        $livros = Livro::all();
        return view('livros', compact('livro', 'livros'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'titulo' => 'required',
            'autor' => 'required',
            'isbn' => 'required|unique:livros,isbn,'.$id,
            'editora' => 'required',
            'ano' => 'required|integer',
            'preco' => 'required|numeric',
            'quantidade' => 'required|integer|min:1',
            'genero' => 'required|string',
        ]);

        $livro = Livro::findOrFail($id);
        $livro->update($request->all());
        return redirect()->route('livros.index')->with('success', 'Livro atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $livro = Livro::findOrFail($id);
        $livro->delete();
        return redirect()->route('livros.index')->with('success', 'Livro excluído com sucesso!');
    }
}
