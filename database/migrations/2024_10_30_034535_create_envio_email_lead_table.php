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
        Schema::create('envio_email_lead', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lead_id');
            $table->string('tag');
            $table->unsignedBigInteger('disparo_email_tag_id');
            $table->dateTime('data_envio');
            $table->foreign('disparo_email_tag_id')->references('id')->on('disparo_email_tag');
            $table->foreign('lead_id')->references('id')->on('lead');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('envio_email_lead');
    }
};
