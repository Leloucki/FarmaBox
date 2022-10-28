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
        Schema::create('enderecos', function (Blueprint $table) {
            $table->id();
            $table->string('complemento')->nullable();
            $table->integer('numero');
            $table->string('logradouro');
            $table->string('bairro');
            $table->string('cidade');
            $table->string('estado');
            $table->string('pais');
            $table->string('cep');
            $table->timestamps();            
        });

        Schema::table('enderecos', function (Blueprint $table) {
            $table->foreignId('id_cliente')->constrained('clientes')
            ->cascadeOnUpdate()
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
        Schema::dropIfExists('enderecos');
    }
};
