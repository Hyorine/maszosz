<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetType extends Model
{

    protected $table = 'target_types';

    protected $fillable = [
        'name',
    ];

}
