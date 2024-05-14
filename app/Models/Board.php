<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'message_id';
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
        public function favorite_users()
    {
        return $this->belongsToMany(User::class, 'favorites', 'message_id', 'user_id')->withTimestamps();
    }
}
