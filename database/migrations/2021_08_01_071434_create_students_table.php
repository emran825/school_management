<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('student_no');
            $table->text('address');
            $table->string('email');
            $table->string('contact_no');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->date('dob');
            $table->enum('gender',['Male','Female','She-Male'])->default('Male');
            $table->string('parent_name');
            $table->string('parent_contact_no');
            $table->string('parent_email');
            $table->text('remarks')->nullable();
            $table->enum('status',['Active','Inactive'])->default('Active');
            $table->string('school_id');
            $table->integer('class_id');
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
        Schema::dropIfExists('students');
    }
}
