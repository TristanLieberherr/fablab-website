<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimelineEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timeline_events', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('job_id');
          $table->enum('type', ['status', 'file', 'message']);
          $table->boolean('notify_user')->default(false);
          $table->string('data')->nullable();
          $table->timestamps();
  
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
      Schema::dropIfExists('timeline_events');
      DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
