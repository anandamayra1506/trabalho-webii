@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Bem-vindo ao Sistema de Livraria</h1>
    <p>Acesse as seções principais do sistema abaixo:</p>

    <div class="list-group">
        <a href="{{ route('fornecedores.index') }}" class="list-group-item list-group-item-action">Fornecedores</a>
        <a href="{{ route('clientes.index') }}" class="list-group-item list-group-item-action">Clientes</a>
        <a href="{{ route('livros.index') }}" class="list-group-item list-group-item-action">Livros</a>
        <a href="{{ route('vendas.index') }}" class="list-group-item list-group-item-action">Vendas</a>
    </div>
</div>
@endsection
