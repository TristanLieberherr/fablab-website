<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
  /**
    * Run the migrations.
    *
    * @return void
    */
  public function up()
  {
    Schema::create('jobs', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('client_id');
      $table->unsignedBigInteger('technician_id')->nullable();
      $table->string('job_type');
      $table->text('description')->nullable();
      $table->enum('status', ['new', 'assigned', 'ongoing', 'on-hold','completed'])->default('new');
      $table->string('deadline');
      $table->boolean('notify_client')->default(true);
      $table->boolean('notify_technician')->default(true);
      $table->string('client_name');
      $table->string('client_surname');
      $table->string('technician_name')->nullable();
      $table->string('technician_surname')->nullable();
      $table->integer('rating')->nullable();
      $table->timestamps();
      $table->softDeletes();

      $table->foreign('client_id')->references('id')->on('users');
      $table->foreign('technician_id')->references('id')->on('users');
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
    Schema::dropIfExists('jobs');
    DB::statement('SET FOREIGN_KEY_CHECKS = 0');
  }
}