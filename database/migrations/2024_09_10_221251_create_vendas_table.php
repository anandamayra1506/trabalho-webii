<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendasTable extends Migration
{
    public function up()
    {
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('livro_id')->constrained('livros')->onDelete('cascade');
            $table->string('cliente_nome');
            $table->integer('quantidade');
            $table->decimal('preco_total', 8, 2);
            $table->string('status')->default('Em andamento'); // Pode ser 'Finalizada' ou 'Cancelada'
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vendas');
    }
}
