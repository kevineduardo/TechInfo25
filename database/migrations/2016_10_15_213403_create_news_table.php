<?php
// Copyright (C) 2016  Kevin Souza
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // a gente cria uma tabela pra manter o histórico de usuários
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('subtitle');
            $table->longText('text');
            $table->boolean('published');
            $table->integer('author_id')->unsigned()->nullable();
            $table->foreign('author_id')
                  ->references('id')->on('users')
                  ->onDelete('set null');
            $table->boolean('edited')->default(false);
            $table->integer('editor_id')->unsigned()->nullable();
            $table->foreign('editor_id')
                    ->references('id')->on('users')
                    ->onDelete('set null');
            $table->string('tags');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
