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
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->string('titulo');
            $table->longText('conteudo');
            $table->boolean('visivel')->default(true);
            $table->timestamp('dataDePublicacao')->useCurrent()->useCurrentOnUpdate();
            $table->timestamps();
            $table->unsignedInteger('categoriaId')->nullable()->constrained();
            $table->foreign('categoriaId')->nullable()->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
