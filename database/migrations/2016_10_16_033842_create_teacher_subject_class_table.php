<?php
// Copyright (C) 2016  Kevin Souza
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherSubjectClassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_subject_class', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('teacher_id')->unsigned();
            $table->foreign('teacher_id')
                    ->references('id')->on('teachers')
                    ->onDelete('cascade');
            $table->integer('subject_id')->unsigned();
            $table->foreign('subject_id')
                    ->references('id')->on('subjects')
                    ->onDelete('cascade');
            $table->integer('class_id')->unsigned();
            $table->foreign('class_id')
                    ->references('id')->on('classes')
                    ->onDelete('cascade');
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
        Schema::dropIfExists('teacher_subject_class');
    }
}
