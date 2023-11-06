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
        Schema::create('championships', function (Blueprint $table) {
            $table->id();

            $table->string('code')->comment('* Código (obrigatório)');
            $table->string('title')->comment('* Título do Campeonato (obrigatório)');
            // $table->string('image')->comment('* Imagem: (obrigatório)');
            $table->string('city_state')->comment('* Cidade + Estado (select) (obrigatório)');
            $table->date('date')->comment('* Data de Realização (obrigatório)')->index();
            $table->text('about')->comment('* Sobre o evento (Ckeditor) (obrigatório)');
            $table->string('gym_place')->comment('* Ginásio (Ckeditor)  (obrigatório)');
            $table->text('info')->comment('* Informações Gerais (Ckeditor) (obrigatório)');
            $table->text('public_entrance')->nullable()->comment('* Entrada ao Público (Ckeditor) (preenchimento opcional)');
            $table->string('type')->comment('* Tipo: (Select: “Kimono” ou “No-Gi) / (obrigatório)');
            $table->string('phase')->comment('* Fase (select: 3 opções mencionadas anteriormente) (obrigatório)')->index();
            $table->boolean('active_status')->comment('* Status: Ativo/Inativo (obrigatório)');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('championships');
    }
};
