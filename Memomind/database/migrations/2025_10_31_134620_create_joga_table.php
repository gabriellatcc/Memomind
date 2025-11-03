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
        Schema::create('Joga', function (Blueprint $table) {
            $table->foreignId('fk_User_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->foreignId('fk_Partida_codPartida')
                ->references('codPartida')
                ->on('Partida')
                ->onDelete('restrict');

            $table->integer('pontuacaoObtida')->default(0);

            $table->primary(['fk_User_id', 'fk_Partida_codPartida']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('joga');
    }
};
