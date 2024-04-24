<?php

namespace Database\Seeders;

use App\Models\StudentDetail;
use App\Models\User;
use App\Models\ClassModel;
use App\Models\StudyProgram;
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
      'name' => 'Atiqah Nurul Asri, S.Pd., M.Pd',
      'username' => '197606252005012001',
      'email' => 'atiqah.nurul@polinema.ac.id',
      'password' => bcrypt('atiqah.nurul@polinema.ac.id'),
      'role' => 'lecturer',
      'gender' => 'female',
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

    StudyProgram::create([
      'name' => 'D4 Teknik Informatika'
    ]);

    StudyProgram::create([
      'name' => 'D4 Sistem Informasi Bisnis'
    ]);

    $studyProgramD4TI = StudyProgram::where('name', 'D4 Teknik Informatika')->first();
    $studyProgramD4SIB = StudyProgram::where('name', 'D4 Sistem Informasi Bisnis')->first();

    $sib3a = ClassModel::create([
        'name' => '3A',
        'study_program_id' => $studyProgramD4SIB->id,
    ]);

    StudentDetail::create([
      'user_id' => 4,
      'study_program_id' => $studyProgramD4SIB->id,
      'class_id' => $sib3a->id,
    ]);
  }
}
