<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeshnehadsCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peshnehad_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->text('comment');
            $table->integer('peshnehad_id');
            $table->integer('user_id'); 
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
        Schema::dropIfExists('peshnehad_comments');
    }
}
