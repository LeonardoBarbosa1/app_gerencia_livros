<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('livros', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 100);
            $table->year('ano_publicacao');
           

            $table->string('autor', 100);
            $table->string('cep', 10)->nullable();
            $table->string('cidade', 100)->nullable();
            $table->string('estado', 50)->nullable();
            $table->string('bairro', 100)->nullable();
            $table->string('rua', 100)->nullable();
            $table->string('numero', 10)->nullable();
            $table->string('complemento', 100)->nullable();
            $table->string('isbn', 13)->nullable()->unique();
            $table->text('descricao')->nullable();
            $table->string('nome_imagem')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livros');
    }
};
