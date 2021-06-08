<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    // \App\Models\User::factory(10)->create();
    User::insert([
      'name' => 'Lieberherr',
      'surname' => 'Tristan',
      'email' => 'tristan',
      'password' => bcrypt('password'),
    ]);
    User::insert([
      'name' => 'Chevallier',
      'surname' => 'Yves',
      'email' => 'yves',
      'password' => bcrypt('password'),
    ]);
      User::insert([
      'name' => '1',
      'surname' => 'Tech',
      'email' => 'tech',
      'is_technician' => true,
      'password' => bcrypt('password'),
    ]);
    User::insert([
      'name' => '2',
      'surname' => 'Tech',
      'email' => 'tech2',
      'is_technician' => true,
      'password' => bcrypt('password'),
  ]);
  }
}
