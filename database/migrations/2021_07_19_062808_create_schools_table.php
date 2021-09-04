<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('address')->nullable();
            $table->string('email');
            $table->string('contact_no');
            $table->string('principle_name');
            $table->string('principle_contact_no')->nullable();
            $table->string('reference_person');
            $table->string('reference_contact_no');
            $table->date('registration_date');
            $table->date('valid_till')->nullable();
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('schools');
    }
}
