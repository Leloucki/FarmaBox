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
        Schema::create('categoria_produtos', function(Blueprint $table){
            $table->id();
            $table->timestamps();
        });

        Schema::table('categoria_produtos', function(Blueprint $table){
            $table->foreignId('id_produto')->constrained('produtos')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();            
            $table->foreignId('id_categoria')->constrained('categorias')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categoria_produtos');
    }
};
