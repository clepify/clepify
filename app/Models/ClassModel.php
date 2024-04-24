<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StudyProgram;
use App\Models\StudentDetail as Student;

class ClassModel extends Model
{
    use HasFactory;

    protected $table = 'class';

    protected $fillable = ['name', 'study_program_id']; // Kolom yang dapat diisi secara massal

    public function studyProgram()
    {
        return $this->belongsTo(StudyProgram::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
