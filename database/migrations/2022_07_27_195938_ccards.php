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
        Schema::create('ccards', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('numero');
            $table->string('dataExp');
            $table->integer('cvv');
            $table->timestamps();  
        });

        Schema::table('ccards', function (Blueprint $table) {
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
        Schema::dropIfExists('ccards');
    }
};
