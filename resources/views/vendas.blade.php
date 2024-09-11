@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ isset($venda) ? 'Editar Venda' : 'Cadastrar Venda' }}</h1>

    <!-- Formulário para Cadastrar/Editar Venda -->
    <form action="{{ isset($venda) ? route('vendas.update', $venda->id) : route('vendas.store') }}" method="POST">
        @csrf
        @if(isset($venda))
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="livro_id">Livro</label>
            <select name="livro_id" class="form-control" required>
                @foreach($livros as $livro)
                    <option value="{{ $livro->id }}" {{ isset($venda) && $venda->livro_id == $livro->id ? 'selected' : '' }}>
                        {{ $livro->titulo }} ({{ $livro->quantidade }} disponível)
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="cliente">Cliente</label>
            <input type="text" name="cliente" class="form-control" value="{{ old('cliente', $venda->cliente ?? '') }}" required>
        </div>

        <div class="form-group">
            <label for="quantidade">Quantidade</label>
            <input type="number" name="quantidade" class="form-control" value="{{ old('quantidade', $venda->quantidade ?? '') }}" required>
        </div>

        <div class="form-group">
            <label for="data_venda">Data da Venda</label>
            <input type="date" name="data_venda" class="form-control" value="{{ old('data_venda', $venda->data_venda ?? '') }}" required>
        </div>

        <button type="submit" class="btn btn-success">{{ isset($venda) ? 'Atualizar' : 'Cadastrar' }}</button>
    </form>

    <!-- Listagem de Vendas -->
    <h2 class="mt-5">Lista de Vendas</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Livro</th>
                <th>Cliente</th>
                <th>Quantidade</th>
                <th>Data da Venda</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vendas as $venda)
            <tr>
                <td>{{ $venda->livro->titulo }}</td>
                <td>{{ $venda->cliente }}</td>
                <td>{{ $venda->quantidade }}</td>
                <td>{{ $venda->data_venda }}</td>
                <td>
                    <a href="{{ route('vendas.edit', $venda->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('vendas.destroy', $venda->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" type="submit">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
