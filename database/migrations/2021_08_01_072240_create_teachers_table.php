<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('teacher_id');
            $table->text('address');
            $table->string('email');
            $table->string('contact_no');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->date('dob');
            $table->string('nationality');
            $table->enum('gender',['Male','Female','She-Male'])->default('Male');
            $table->string('last_qualification');
            $table->string('speciality');
            $table->enum('job_type',['Permanent','Part-time'])->default('Permanent');
            $table->decimal('salary')->nullable();
            $table->text('remarks')->nullable();
            $table->enum('status',['Active','Inactive'])->default('Active');
            $table->string('school_id');
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
        Schema::dropIfExists('teachers');
    }
}
