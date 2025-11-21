<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('atrasos', function (Blueprint $table) {
            $table->id();
            $table->string('linha'); // Ex: '15', '15A'
            $table->string('ponto_critico'); // Ex: 'Bairro da Feira', 'Praça das Corujas'
            $table->integer('tempo_atraso_minutos');
            $table->string('periodo'); // Ex: 'manha', 'tarde', 'noite'
            $table->date('data_ocorrencia');
            $table->text('mensagem_original')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('atrasos');
    }
};