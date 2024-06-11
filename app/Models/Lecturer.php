<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
        'gender',
        'phone'
    ];

    public function scopeLecturers($query)
    {
        return $query->where('role', 'lecturer');
    }

    public function letters()
    {
        return $this->belongsToMany(Letter::class, 'letter_lecturer', 'lecturer_id', 'letter_id');
    }
}
