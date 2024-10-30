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
        Schema::create('lancamento', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('negocio_id');
            $table->foreign('negocio_id')->references('id')->on('negocio');
            $table->string('versao');
            $table->date('dt_inicio_cap_lead');
            $table->dateTime('dt_inicio_lancamento');
            $table->dateTime('dt_termino_lancamento');
            $table->integer('meta_captura_leads');
            $table->integer('meta_leads_na_live');
            $table->string('status');
            $table->timestamps();
            $table->softDeletes('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lancamento');
    }
};
