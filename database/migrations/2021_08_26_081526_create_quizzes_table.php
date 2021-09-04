<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('school_id');
            $table->integer('year_id');
            $table->integer('class_id');
            $table->integer('subject_id');
            $table->integer('topic_id');
            $table->string('title');
            $table->text('instruction')->nullable();
            $table->string('attachment')->nullable();
            $table->string('remote_media_file_link')->nullable();
            $table->integer('total_question')->nullable();
            $table->enum('status',['Active','Inactive'])->default('Active');
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
        Schema::dropIfExists('quizzes');
    }
}
