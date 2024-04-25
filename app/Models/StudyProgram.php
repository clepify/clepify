<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyProgram extends Model
{
  use HasFactory;

  protected $fillable = ['level', 'code', 'name'];

  public function class()
  {
    return $this->hasMany(ClassModel::class, 'study_program_id');
  }
}
