<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentDetail extends Model
{
  use HasFactory;

  protected $fillable = [
    'user_id',
    'study_program_id',
    'class_id'
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function studyProgram()
  {
    return $this->hasOne(StudyProgram::class, 'id', 'study_program_id');
  }

  public function class()
  {
    return $this->hasOne(ClassModel::class, 'id', 'class_id');
  }
}
