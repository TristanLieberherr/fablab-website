<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('messages', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');
        $table->unsignedBigInteger('job_id');
        $table->text('text');
        $table->boolean('notify')->default(true);
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users');
        $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
        //$table->softDeletes();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      DB::statement('SET FOREIGN_KEY_CHECKS = 0');
      Schema::dropIfExists('messages');
      DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
