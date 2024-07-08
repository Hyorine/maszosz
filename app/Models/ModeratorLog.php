<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModeratorLog extends Model
{

    use HasFactory;

    protected $fillable = [
        'moderator_id',
        'action',
        'target_id',
        'target_type_id',
        'comment',
    ];
    
    public function moderator()
    {
        return $this->belongsTo(User::class, 'moderator_id');
    }

}
