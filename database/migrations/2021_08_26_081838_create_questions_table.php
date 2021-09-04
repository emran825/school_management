<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quiz_id');
            $table->text('question_detail');
            $table->float('mark')->nullable();
            $table->enum('type',['Multiple-choice','Single-Choice','Picture-choice','True/false','Free-text','Fill-in-the-blanks','Match-pair','Ordering','Highlight'])->default('Multiple-choice');
            $table->string('image')->nullable();
            $table->string('audio')->nullable();
            $table->tinyInteger('serial');
            $table->string('attachment')->nullable();
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
        Schema::dropIfExists('questions');
    }
}
