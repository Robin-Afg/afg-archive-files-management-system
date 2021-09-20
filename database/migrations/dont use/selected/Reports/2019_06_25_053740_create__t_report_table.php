<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('crida_number')->unique();
            $table->string('file_type')->default('report');
            $table->date('date_of_archiving')->nullable();          
            $table->text('kholasmatlab')->nullable();
            $table->string('report_num')->nullable();
            $table->string('author')->nullable();
            $table->string('year')->nullable();
            $table->string('revised_num')->nullable();
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
        Schema::dropIfExists('treports');
    }
}
