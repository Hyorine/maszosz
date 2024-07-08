<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class monster extends Model
{

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'place',
        'behavior',
        'rarity_level',
        'danger_level',
        'nutrition',
        'created_at',
        'updated_at',
        'image',
    ];

    protected $indexes = [
        'user_id',
    ];

    protected $casts = [
        'rarity_level' => 'int',
        'danger_level' => 'int',
    ];

}
