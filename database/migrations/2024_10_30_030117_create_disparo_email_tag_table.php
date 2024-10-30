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
        Schema::create('disparo_email_tag', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lancamento_id');
            $table->string('tag');
            $table->string('assunto');
            $table->string('mensagem');
            $table->dateTime('data_disparo')->text('Não obrigatório, mas se preenchido, será disparado email nesa data para todos com a Tag definida');
            $table->integer('tempo_disparo')->text('Disparar e-mail após o tempo configurado (Ex: 1s ou 4h ou 2d). Se o campo data_disparo for preenchido, este campo será NULL.'); 
            $table->integer('repetir')->text('Repetir o tempo de disparo por quantas vezes? Se o campo data_disparo for preenchido, este campo será NULL.');
            $table->foreign('lancamento_id')->references('id')->on('lancamento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disparo_email_tag');
    }
};
