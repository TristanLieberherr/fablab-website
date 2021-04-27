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
        $table->enum('status', ['new','on-hold','completed','ongoing'])->default('new');
        $table->boolean('status_alert')->default(false);
        $table->string('deadline');
        $table->timestamps();

        $table->foreign('client_id')->references('id')->on('users');
        $table->foreign('technician_id')->references('id')->on('users');
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
      Schema::dropIfExists('jobs');
      DB::statement('SET FOREIGN_KEY_CHECKS = 0');
    }
}
