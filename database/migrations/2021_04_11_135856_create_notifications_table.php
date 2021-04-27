<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('notifications', function (Blueprint $table) {
        $table->id();
        $table->integer('user_id');
        $table->string('text');
        $table->string('type');
        $table->integer('type_id');
        $table->integer('count');
        $table->timestamps();
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
      DB::statement('SET FOREIGN_KEY_CHECKS = 1');
      Schema::dropIfExists('notifications');
      DB::statement('SET FOREIGN_KEY_CHECKS = 0');
    }
}
