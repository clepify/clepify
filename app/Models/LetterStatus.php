<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LetterStatus extends Model
{
    use HasFactory;

    protected $table = 'letter_status';

    protected $fillable = [
        'letter_id',
        'user_id',
        'status_before',
        'status_after',
    ];

    public function letter()
    {
        return $this->belongsTo(Letter::class, 'letter_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
