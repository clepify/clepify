<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
  use HasFactory;

  protected $fillable = [
    'student_id',
    'date_sent',
    'duration',
    'type',
    'category',
    'status',
    'letter_document',
    'support_document'
  ];

  public function student()
  {
    return $this->belongsTo(User::class, 'student_id');
  }

  public function lecturer()
  {
    return $this->belongsToMany(Lecturer::class, 'letter_lecturer', 'letter_id', 'lecturer_id');
  }
}
