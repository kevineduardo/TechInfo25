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
            $table->longText('text');
            $table->string('navbar_icon');
            $table->integer('type')->default(1);
            $table->string('custom_url')->nullable();
            $table->integer('author_id')->unsigned()->nullable();
            $table->foreign('author_id')
                    ->references('id')->on('teachers')
                    ->onDelete('set null');
            $table->boolean('edited')->default(false);
            $table->integer('editor_id')->unsigned()->nullable();
            $table->foreign('editor_id')
                    ->references('id')->on('teachers')
                    ->onDelete('set null');
            $table->string('tags')->nullable();
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
