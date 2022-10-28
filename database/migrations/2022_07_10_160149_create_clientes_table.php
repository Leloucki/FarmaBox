<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('celular');
            $table->string('cpf');
            $table->timestamps();
        });

        Schema::table('clientes', function (Blueprint $table) {
            $table->foreignId('id_usuario')
            ->constrained('usuarios')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();

            $table->foreignId('id_assin')
            ->nullable()
            ->constrained('assinaturas')
            ->cascadeOnUpdate()
            ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
};
