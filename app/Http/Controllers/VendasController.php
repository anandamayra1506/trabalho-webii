<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use App\Models\Livro;
use Illuminate\Http\Request;

class VendasController extends Controller
{
    public function index()
    {
        $vendas = Venda::with('livro')->get();
        return view('vendas', compact('vendas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'livro_id' => 'required|exists:livros,id',
            'cliente_nome' => 'required|string',
            'quantidade' => 'required|integer|min:1',
        ]);

        $livro = Livro::findOrFail($request->livro_id);

        // Verificar se há estoque suficiente
        if ($livro->quantidade < $request->quantidade) {
            return back()->withErrors('Quantidade insuficiente em estoque.');
        }

        // Calcular o preço total
        $precoTotal = $livro->preco * $request->quantidade;

        // Criar a venda
        Venda::create([
            'livro_id' => $request->livro_id,
            'cliente_nome' => $request->cliente_nome,
            'quantidade' => $request->quantidade,
            'preco_total' => $precoTotal,
        ]);

        // Atualizar a quantidade de livros no estoque
        $livro->decrement('quantidade', $request->quantidade);

        return redirect()->route('vendas.index')->with('success', 'Venda cadastrada com sucesso!');
    }

    public function edit($id)
    {
        $venda = Venda::findOrFail($id);
        $livros = Livro::all();
        return view('vendas', compact('venda', 'livros'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'livro_id' => 'required|exists:livros,id',
            'cliente_nome' => 'required|string',
            'quantidade' => 'required|integer|min:1',
        ]);

        $venda = Venda::findOrFail($id);
        $livro = Livro::findOrFail($venda->livro_id);

        // Verificar se houve mudança na quantidade
        if ($request->quantidade != $venda->quantidade) {
            $diferenca = $request->quantidade - $venda->quantidade;
            if ($diferenca > 0 && $livro->quantidade < $diferenca) {
                return back()->withErrors('Quantidade insuficiente em estoque.');
            }
            $livro->decrement('quantidade', $diferenca);
        }

        // Atualizar a venda
        $venda->update($request->all());
        return redirect()->route('vendas.index')->with('success', 'Venda atualizada com sucesso!');
    }

    public function cancel($id)
    {
        $venda = Venda::findOrFail($id);
        $livro = Livro::findOrFail($venda->livro_id);

        // Devolver os livros ao estoque
        $livro->increment('quantidade', $venda->quantidade);

        // Marcar a venda como cancelada
        $venda->update(['status' => 'Cancelada']);

        return redirect()->route('vendas.index')->with('success', 'Venda cancelada e estoque atualizado!');
    }
}
