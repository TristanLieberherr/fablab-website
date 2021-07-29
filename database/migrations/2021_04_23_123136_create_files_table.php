<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
  /**
    * Run the migrations.
    *
    * @return void
    */
  public function up()
  {
    Schema::create('files', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('job_id');
      $table->string('hashed_name');
      $table->string('name');
      $table->timestamps();

      $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
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
    Schema::dropIfExists('files');
    DB::statement('SET FOREIGN_KEY_CHECKS = 0');
  }
}