<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('notifiable_id');
            $table->integer('file_id')->nullable();
            $table->string('type');
            $table->integer('comment_id')->nullable();
            $table->datetime('read')->nullable();
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
        Schema::dropIfExists('notis');
    }
}
