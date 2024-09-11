<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ isset($fornecedor) ? 'Editar Fornecedor' : 'Cadastrar Fornecedor' }}</h1>

    <!-- Formulário para Cadastrar/Editar Fornecedor -->
    <form action="{{ isset($fornecedor) ? route('fornecedores.update', $fornecedor->id) : route('fornecedores.store') }}" method="POST">
        @csrf
        @if(isset($fornecedor))
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="empresa">Empresa</label>
            <input type="text" name="empresa" class="form-control" value="{{ old('empresa', $fornecedor->empresa ?? '') }}" required>
        </div>

        <div class="form-group">
            <label for="vendedor">Vendedor</label>
            <input type="text" name="vendedor" class="form-control" value="{{ old('vendedor', $fornecedor->vendedor ?? '') }}" required>
        </div>

        <div class="form-group">
            <label for="cnpj">CNPJ</label>
            <input type="text" name="cnpj" class="form-control" value="{{ old('cnpj', $fornecedor->cnpj ?? '') }}" required>
        </div>

        <div class="form-group">
            <label for="endereco">Endereço</label>
            <input type="text" name="endereco" class="form-control" value="{{ old('endereco', $fornecedor->endereco ?? '') }}" required>
        </div>

        <div class="form-group">
            <label for="telefone">Telefone</label>
            <input type="text" name="telefone" class="form-control" value="{{ old('telefone', $fornecedor->telefone ?? '') }}">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $fornecedor->email ?? '') }}" required>
        </div>

        <div class="form-group">
            <label for="formapg">Forma de Pagamento</label>
            <input type="text" name="formapg" class="form-control" value="{{ old('formapg', $fornecedor->formapg ?? '') }}">
        </div>

        <div class="form-group">
            <label for="data">Data</label>
            <input type="date" name="data" class="form-control" value="{{ old('data', $fornecedor->data ?? '') }}" required>
        </div>

        <button type="submit" class="btn btn-success">{{ isset($fornecedor) ? 'Atualizar' : 'Cadastrar' }}</button>
    </form>

    <!-- Listagem de Fornecedores -->
    <h2 class="mt-5">Lista de Fornecedores</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Empresa</th>
                <th>Vendedor</th>
                <th>CNPJ</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($fornecedores as $fornecedor)
            <tr>
                <td>{{ $fornecedor->empresa }}</td>
                <td>{{ $fornecedor->vendedor }}</td>
                <td>{{ $fornecedor->cnpj }}</td>
                <td>{{ $fornecedor->email }}</td>
                <td>{{ $fornecedor->telefone }}</td>
                <td>
                    <a href="{{ route('fornecedores.edit', $fornecedor->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('fornecedores.destroy', $fornecedor->id) }}" method="POST" style="display:inline-block;">
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

</x-app-layout>