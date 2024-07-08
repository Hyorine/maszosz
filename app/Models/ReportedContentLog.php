<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportedContentLog extends Model
{

    protected $fillable = [
        'user_id',
        'content_id',
        'target_type_id',
        'comment',
        'is_resolved'
    ];

}
