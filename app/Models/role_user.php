<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class role_user extends Model
{
    protected $table = 'role_user';
    protected $fillable = [
        'user_id',
        'role_id',
        'created_at',
        'confirmation_token'
    ];

    protected $indexes = [
        'user_id',
        'role_id',
    ];
}
