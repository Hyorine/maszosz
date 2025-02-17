<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event',
        'new_monster',
        'watched_post',
        'answered_post',
        'friend_request',
        'friend_accept',
        'private_message',
        'moderation',
        'followed_user',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
