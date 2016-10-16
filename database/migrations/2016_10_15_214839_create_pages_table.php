<?php
// Copyright (C) 2016  Kevin Souza
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('text');
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
        Schema::dropIfExists('pages');
    }
}
