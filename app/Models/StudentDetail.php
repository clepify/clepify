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

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
