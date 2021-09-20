<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaderamaliTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saderamalis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('crida_number')->unique();
            $table->string('file_type')->default('saderamali');
            $table->date('date_of_archiving')->nullable(); 
            $table->date('date_of_sodor')->nullable();
            $table->string('mursal')->nullable();
            $table->string('mursal_alia')->nullable();
            $table->text('kholasmatlab')->nullable();
            $table->string('asal')->nullable();
            $table->string('zamema')->nullable();
            $table->string('copy')->nullable();
            $table->string('num_of_dosia')->nullable();
            $table->string('number_of_archive')->nullable();
            $table->string('place')->nullable();
            $table->string('more')->nullable();
            $table->text('file')->nullable();
            $table->uuid('uuid')->nullable();
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
        Schema::dropIfExists('saderamalis');
    }
}
