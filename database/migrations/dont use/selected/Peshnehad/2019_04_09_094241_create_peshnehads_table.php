<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeshnehadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peshnehads', function (Blueprint $table) {
           $table->increments('id');
           $table->string('crida_number')->unique();
           $table->string('file_type')->default('peshnehad'); 
           $table->date('date_of_peshnehad')->nullable();
           $table->date('date_of_archiving')->nullable(); 
           $table->string('add_of_peshnehader')->nullable();
           $table->text('kholasmatlab')->nullable();
           $table->string('to')->nullable();
           $table->string('asal')->nullable();
           $table->string('zamema')->nullable();
           $table->string('copy')->nullable();
           $table->string('taslemi')->nullable();
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
        Schema::dropIfExists('peshnehads');
    }
}
