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
        Schema::create('produtos_clientes', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('quantidade');
            $table->timestamps();
        });

        Schema::table('produtos_clientes', function (Blueprint $table) {
            $table->foreignId('id_produto')->constrained('produtos')
            ->cascadeOnUpdate()
            ->cascadeOnDelete();
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
        Schema::dropIfExists('produtos_cliente');
    }
};
