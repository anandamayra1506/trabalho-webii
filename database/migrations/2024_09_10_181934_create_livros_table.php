<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLivrosTable extends Migration
{
    public function up()
    {
        Schema::create('livros', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('autor');
            $table->string('isbn')->unique();
            $table->string('editora');
            $table->year('ano');
            $table->decimal('preco', 8, 2);
            $table->integer('quantidade');
            $table->string('genero');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('livros');
    }
}
