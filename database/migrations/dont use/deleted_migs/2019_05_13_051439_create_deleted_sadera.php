<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeletedSadera extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deleted_saderas', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('database_id')->nullable(); 
            $table->string('crida_number')->nullable();
           $table->string('file_type')->default('sadera')->nullable();  
           $table->date('dateofmaktoob')->nullable();
           $table->string('mursal')->nullable();
           $table->string('mursal_alia')->nullable();
           $table->text('kholasmatlab')->nullable();
           $table->string('asal')->nullable();
           $table->string('copy')->nullable();
           $table->string('zamema')->nullable();
           $table->string('num_of_dosia')->nullable();
           $table->string('almary')->nullable();
           $table->date('date_of_archiving')->nullable();
           $table->string('place')->nullable();
           $table->string('more')->nullable();
           $table->string('action')->nullable();
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
        Schema::dropIfExists('deleted_saderas');
    }
}
