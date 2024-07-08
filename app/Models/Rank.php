<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'created_at', 'updated_at'];

    // Define any relationships here, if needed
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
