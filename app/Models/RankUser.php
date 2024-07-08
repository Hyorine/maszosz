<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RankUser extends Model
{
    // Define the table name explicitly
    protected $table = 'rank_user';

    // Disable auto-incrementing of primary key
    public $incrementing = false;
    
    protected $fillable = [
        'rank_id',
        'user_id',
        'updated_at',
        'created_at',
    ];

    public $timestamps = true;
}
