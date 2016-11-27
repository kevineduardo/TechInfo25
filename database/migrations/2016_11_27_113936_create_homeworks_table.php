<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomeworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homeworks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('teacher_id')->unsigned();
            $table->integer('subject_id')->unsigned();
            $table->integer('class_id')->unsigned();
            $table->foreign('teacher_id')
                    ->references('id')->on('teachers')
                    ->onDelete('cascade');
            $table->foreign('subject_id')
                    ->references('id')->on('subjects')
                    ->onDelete('cascade');
            $table->foreign('class_id')
                    ->references('id')->on('classes')
                    ->onDelete('cascade');
            $table->string('title');
            $table->string('path');
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
        Schema::dropIfExists('homeworks');
    }
}
