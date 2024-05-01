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

    protected $fillable = ['level', 'name', 'study_program_id'];

    public function studyProgram()
    {
        return $this->belongsTo(StudyProgram::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'class_id');
    }
}
