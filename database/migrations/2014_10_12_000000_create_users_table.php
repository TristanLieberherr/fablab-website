<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('users', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('surname');
      $table->string('email')->unique();
      $table->boolean('is_technician')->default(false);
      $table->string('password')->nullable();
      $table->boolean('notify_email_status')->default(true);
      $table->boolean('notify_email_messages')->default(true);
      $table->boolean('notify_email_files')->default(true);
      $table->timestamp('notify_email_updated_at')->useCurrent();
  
      $table->rememberToken();
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
    DB::statement('SET FOREIGN_KEY_CHECKS = 0');
    Schema::dropIfExists('users');
    DB::statement('SET FOREIGN_KEY_CHECKS = 1');
  }
}
