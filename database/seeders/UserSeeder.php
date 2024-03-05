<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    User::create([
      'name' => 'Administrator',
      'username' => 'admin',
      'email' => 'admin@mail.com',
      'password' => bcrypt('admin@mail.com'),
      'role' => 'admin',
      'gender' => 'female',
      'phone' => '081234567890',
    ]);

    User::create([
      'name' => 'Rudy Ariyanto, ST, M.Cs',
      'username' => '197111101999031002',
      'email' => 'ariyantorudy@polinema.ac.id',
      'password' => bcrypt('ariyantorudy@polinema.ac.id'),
      'role' => 'lecturer',
      'gender' => 'male',
      'phone' => '081234567890',
    ]);

    User::create([
      'name' => 'Andhika Dwi Khalisyahputra',
      'username' => '2141762114',
      'email' => 'andhikadwi980@gmail.com',
      'password' => bcrypt('andhikadwi980@gmail.com'),
      'role' => 'student',
      'gender' => 'male',
      'phone' => '081234567890',
    ]);
  }
}
