<?php

namespace App\Models;

use App\Models\Letter;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'name',
    'username',
    'email',
    'password',
    'role',
    'gender',
    'phone'
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
    'password' => 'hashed',
  ];

  public function scopeLecturers($query)
  {
    return $query->where('role', 'lecturer');
  }

  public function scopeStudents($query)
  {
    return $query->select('users.*', 'study_programs.name as study_program_name', 'class.name as class_name')
      ->join('student_details', function ($join) {
        $join->on('users.id', '=', 'student_details.user_id')
          ->join('study_programs', 'student_details.study_program_id', '=', 'study_programs.id')
          ->join('class', 'student_details.class_id', '=', 'class.id');
      })->where('role', 'student');
  }

  public function studentDetail()
  {
    return $this->hasOne(StudentDetail::class);
  }

  public function letter()
  {
    return $this->hasMany(Letter::class, 'student_id');
  }
}
