<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'date',
        'duration',
        'type',
        'category',
        'status',
        'letter_document',
        'support_document',
        'feedback_message',
    ];

    public function scopeActive()
    {
        return $this->where('status', '!=', 'Archived');
    }

    public function scopeArchived()
    {
        return $this->where('status', 'Archived');
    }

    public function letterStatus()
    {
        return $this->hasMany(LetterStatus::class, 'letter_id');
    }

    public function letterSignature()
    {
        return $this->hasMany(LetterSignature::class, 'letter_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function lecturer()
    {
        return $this->belongsToMany(Lecturer::class, 'letter_lecturer', 'letter_id', 'lecturer_id');
    }
}
