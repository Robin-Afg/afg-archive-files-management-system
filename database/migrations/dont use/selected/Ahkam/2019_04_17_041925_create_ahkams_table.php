<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAhkamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ahkams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('crida_number')->unique();
            $table->string('file_type')->default('ahkam');
            $table->date('date_of_archiving')->nullable();     
            $table->string('type_of_document')->nullable();
            $table->string('number_of_document')->nullable();
            $table->date('date_of_document')->nullable();              
            $table->text('kholasmatlab')->nullable();
            $table->string('molahezat')->nullable();         
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
        Schema::dropIfExists('ahkams');
    }
}
