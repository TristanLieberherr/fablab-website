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
          'name' => 'tristan',
          'email' => 'tristan',
          'password' => bcrypt('password'),
      ]);
        User::insert([
          'name' => 'tech',
          'email' => 'tech',
          'is_technician' => true,
          'password' => bcrypt('password'),
      ]);
    }
}
