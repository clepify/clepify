<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentDetail extends Model
{
  use HasFactory;

  protected $fillable = [
    'user_id',
    'study_program',
    'class'
  ];

  public function scopeStudyProgramAbbrievation()
  {
    $study_program = $this->study_program;
    switch ($study_program) {
      case 'D4 Teknik Informatika':
        return 'D4 TI';
      case 'D4 Sistem Informasi Bisnis':
        return 'D4 SIB';
      default:
        return $study_program;
    }
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function studyProgram()
  {
    return $this->hasOne(StudyProgram::class);
  }

  public function class()
  {
    return $this->hasOne(ClassModel::class);
  }
}
