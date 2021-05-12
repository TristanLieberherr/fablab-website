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
          'name' => 'Tristan',
          'surname' => 'Lieberherr',
          'email' => 'tristan',
          'password' => bcrypt('password'),
      ]);
        User::insert([
          'name' => 'Johnny',
          'surname' => 'Bravo',
          'email' => 'tech',
          'is_technician' => true,
          'password' => bcrypt('password'),
      ]);
      User::insert([
        'name' => 'Johnny',
        'surname' => 'Bravo',
        'email' => 'tech2',
        'is_technician' => true,
        'password' => bcrypt('password'),
    ]);
    }
}
