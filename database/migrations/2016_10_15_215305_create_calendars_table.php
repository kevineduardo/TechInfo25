<?php
// Copyright (C) 2016  Kevin Souza
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->string('place');
            $table->dateTime('date');
            // em role será definido se é pra agenda pública do técnico ou para uma turma especifica
            // exemplos:
            // role = 1 // agenda pública
            // role = 2 // turma do técnico - que deve ser especifica em related_class
            $table->integer('role')->default(1);
            $table->integer('related_class')->unsigned()->nullable();
            $table->foreign('related_class')
                    ->references('id')->on('classes')
                    ->onDelete('cascade');
            $table->integer('author_id')->unsigned();
            $table->foreign('author_id')
                    ->references('id')->on('users')
                    ->onDelete('set null');
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
        Schema::dropIfExists('calendars');
    }
}
