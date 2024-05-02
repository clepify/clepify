<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LetterSignature extends Model
{
    use HasFactory;

    protected $table = 'letter_signature';

    protected $fillable = [
        'letter_id',
        'user_id',
        'signature',
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
