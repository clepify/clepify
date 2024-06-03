<?php

namespace Database\Seeders;

use App\Models\ClassModel;
use App\Models\StudyProgram;
use App\Models\StudentDetail;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AcademicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StudyProgram::create([
            'level' => 'S2',
            'code' => 'RTI',
            'name' => 'Rekayasa Teknologi Informasi'
        ]);

        StudyProgram::create([
            'level' => 'D4',
            'code' => 'TI',
            'name' => 'Teknik Informatika'
        ]);

        StudyProgram::create([
            'level' => 'D4',
            'code' => 'SIB',
            'name' => 'Sistem Informasi Bisnis'
        ]);

        StudyProgram::create([
            'level' => 'D2',
            'code' => 'PPLS',
            'name' => 'Pengembangan Piranti Lunak Situs'
        ]);

        $studyProgramS2RTI = StudyProgram::where('name', 'Rekayasa Teknologi Informasi')->first();
        $studyProgramD4TI = StudyProgram::where('name', 'D4 Teknik Informatika')->first();
        $studyProgramD4SIB = StudyProgram::where('name', 'Sistem Informasi Bisnis')->first();
        $studyProgramD2PPLS = StudyProgram::where('name', 'Pengembangan Piranti Lunak Situs')->first();

        $levels = ['1', '2', '3', '4'];
        $classes = ['A', 'B', 'C', 'D', 'E', 'F'];

        foreach ($levels as $level) {
            foreach ($classes as $class) {
                ClassModel::create([
                    'name' => $class,
                    'level' => $level,
                    'study_program_id' => $studyProgramD4SIB->id,
                ]);
            }
        }

        $sib3a = ClassModel::where('name', 'A')->where('level', '3')->where('study_program_id', $studyProgramD4SIB->id)->first();

        StudentDetail::create([
            'user_id' => 4,
            'study_program_id' => $studyProgramD4SIB->id,
            'class_id' => $sib3a->id,
        ]);
    }
}
