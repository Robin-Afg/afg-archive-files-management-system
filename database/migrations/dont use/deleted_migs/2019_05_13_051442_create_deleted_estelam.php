<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeletedEstelam extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deleted_estelams', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('database_id')->nullable(); 
            $table->string('crida_number');
            $table->string('file_type')->default('estelam');
            $table->date('date_of_archiving')->nullable();
            $table->date('date_of_estelam')->nullable();
            $table->date('date_of_sodor')->nullable();
            $table->string('add_of_sender')->nullable();              
            $table->text('kholasmatlab')->nullable();
            $table->string('wozarat')->nullable();
            $table->string('reyasat')->nullable();
            $table->string('marja')->nullable();
            $table->string('asal')->nullable();
            $table->string('zamema')->nullable();
            $table->string('place')->nullable();
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
        Schema::dropIfExists('deleted_estelams');
    }
}
