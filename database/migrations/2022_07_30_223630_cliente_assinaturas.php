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
        Schema::create('cliente_assinaturas', function (Blueprint $table) {
            $table->id();
            $table->char('sexo');
            $table->string('alergia')->nullable();
            $table->string('observacao')->nullable();
            $table->timestamps();   
        });

        Schema::table('cliente_assinaturas', function (Blueprint $table) {
            $table->foreignId('id_cliente')->constrained('clientes')
            ->cascadeOnUpdate()
            ->cascadeOnDelete();
            $table->foreignId('id_assin')->constrained('assinaturas')
            ->cascadeOnDelete()
            ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cliente_assinaturas');
    }
};
