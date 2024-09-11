@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ isset($livro) ? 'Editar Livro' : 'Cadastrar Livro' }}</h1>

    <!-- Formulário para Cadastrar/Editar Livro -->
    <form action="{{ isset($livro) ? route('livros.update', $livro->id) : route('livros.store') }}" method="POST">
        @csrf
        @if(isset($livro))
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="titulo">Título</label>
            <input type="text" name="titulo" class="form-control" value="{{ old('titulo', $livro->titulo ?? '') }}" required>
        </div>

        <div class="form-group">
            <label for="autor">Autor</label>
            <input type="text" name="autor" class="form-control" value="{{ old('autor', $livro->autor ?? '') }}" required>
        </div>

        <div class="form-group">
            <label for="isbn">ISBN</label>
            <input type="text" name="isbn" class="form-control" value="{{ old('isbn', $livro->isbn ?? '') }}" required>
        </div>

        <div class="form-group">
            <label for="editora">Editora</label>
            <input type="text" name="editora" class="form-control" value="{{ old('editora', $livro->editora ?? '') }}" required>
        </div>

        <div class="form-group">
            <label for="ano">Ano</label>
            <input type="number" name="ano" class="form-control" value="{{ old('ano', $livro->ano ?? '') }}" required>
        </div>

        <div class="form-group">
            <label for="preco">Preço</label>
            <input type="text" name="preco" class="form-control" value="{{ old('preco', $livro->preco ?? '') }}" required>
        </div>

        <div class="form-group">
            <label for="quantidade">Quantidade</label>
            <input type="number" name="quantidade" class="form-control" value="{{ old('quantidade', $livro->quantidade ?? '') }}" required>
        </div>

        <div class="form-group">
            <label for="genero">Gênero</label>
            <input type="text" name="genero" class="form-control" value="{{ old('genero', $livro->genero ?? '') }}" required>
        </div>

        <button type="submit" class="btn btn-success">{{ isset($livro) ? 'Atualizar' : 'Cadastrar' }}</button>
    </form>

    <!-- Listagem de Livros -->
    <h2 class="mt-5">Lista de Livros</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Título</th>
                <th>Autor</th>
                <th>ISBN</th>
                <th>Editora</th>
                <th>Ano</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Gênero</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($livros as $livro)
            <tr>
                <td>{{ $livro->titulo }}</td>
                <td>{{ $livro->autor }}</td>
                <td>{{ $livro->isbn }}</td>
                <td>{{ $livro->editora }}</td>
                <td>{{ $livro->ano }}</td>
                <td>{{ $livro->preco }}</td>
                <td>{{ $livro->quantidade }}</td>
                <td>{{ $livro->genero }}</td>
                <td>
                    <a href="{{ route('livros.edit', $livro->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('livros.destroy', $livro->id) }}" method="POST" style="display:inline-block;">
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

