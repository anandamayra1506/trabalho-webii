@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ isset($cliente) ? 'Editar Cliente' : 'Cadastrar Cliente' }}</h1>

    <!-- Formulário para Cadastrar/Editar Cliente -->
    <form action="{{ isset($cliente) ? route('clientes.update', $cliente->id) : route('clientes.store') }}" method="POST">
        @csrf
        @if(isset($cliente))
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" name="nome" class="form-control" value="{{ old('nome', $cliente->nome ?? '') }}" required>
        </div>

        <div class="form-group">
            <label for="endereco">Endereço</label>
            <input type="text" name="endereco" class="form-control" value="{{ old('endereco', $cliente->endereco ?? '') }}" required>
        </div>

        <div class="form-group">
            <label for="telefone">Telefone</label>
            <input type="text" name="telefone" class="form-control" value="{{ old('telefone', $cliente->telefone ?? '') }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $cliente->email ?? '') }}" required>
        </div>

        <div class="form-group">
            <label for="cpf">CPF</label>
            <input type="text" name="cpf" class="form-control" value="{{ old('cpf', $cliente->cpf ?? '') }}" required>
        </div>

        <button type="submit" class="btn btn-success">{{ isset($cliente) ? 'Atualizar' : 'Cadastrar' }}</button>
    </form>

    <!-- Listagem de Clientes -->
    <h2 class="mt-5">Lista de Clientes</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Endereço</th>
                <th>Telefone</th>
                <th>Email</th>
                <th>CPF</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientes as $cliente)
            <tr>
                <td>{{ $cliente->nome }}</td>
                <td>{{ $cliente->endereco }}</td>
                <td>{{ $cliente->telefone }}</td>
                <td>{{ $cliente->email }}</td>
                <td>{{ $cliente->cpf }}</td>
                <td>
                    <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" style="display:inline-block;">
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
