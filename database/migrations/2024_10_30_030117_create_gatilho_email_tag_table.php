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
        Schema::create('gatilho_email_tag', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('campanha_id');
            $table->string('tag', 100);
            $table->string('assunto', 100);
            $table->text('mensagem');
            $table->string('tipo_disparo', 15)->nullable()->text('IMEDIATAMENTE | DATA | DIA(S) | HORA(S) | MINUTO(S) | SEGUNDO(S) | MES(ES)');
            $table->integer('tempo_disparo')->nullable()->text('Disparar e-mail de acordo com o tipo e tempo de disparo. Ex: 1 dia, 1 hora, 1 mês, etc...'); 
            $table->timestamp('data_disparo')->nullable()->text('Disparar e-mail nesta data'); 
            $table->integer('repetir')->nullable()->text('Repetir o tempo de disparo por quantas vezes? Se o campo data_disparo for preenchido, este campo será NULL.');
            $table->foreign('campanha_id')->references('id')->on('campanha');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gatilho_email_tag');
    }
};
