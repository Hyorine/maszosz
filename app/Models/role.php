<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class role extends Model
{

    protected $fillable = [
        'name',
        'created_at',
        'updated_at'
    ];

    protected $indexes = [
        'name',
    ];
}
