<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Support\Facades\Log;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'user_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    
    
    public function boards()
    {
        return $this->hasMany(Board::class);
    }
    
    
    public function favorites(){
        return $this->belongsToMany(Board::class, 'favorites', 'user_id', 'message_id')->withTimestamps();
    }

    public function favorite($messageId)
    {
        Log::info('User@favorite start', ['messageId' => $messageId]);

        // すでにお気に入りに追加しているかの確認
        $exist = $this->is_favorite($messageId);

        if ($exist) {
            // すでにお気に入りに追加していれば何もしない
            Log::info('User@favorite already favorited');
            return false;
        } else {
            // 未追加であれば追加する
            $this->favorites()->attach($messageId);
            Log::info('User@favorite favorited');
            return true;
        }
    }

    public function unfavorite($messageId)
    {
        Log::info('User@unfavorite start', ['messageId' => $messageId]);

        // すでにお気に入りに追加しているかの確認
        $exist = $this->is_favorite($messageId);

        if ($exist) {
            // すでにお気に入りに追加していれば削除する
            $this->favorites()->detach($messageId);
            Log::info('User@unfavorite unfavorited');
            return true;
        } else {
            // 未追加であれば何もしない
            Log::info('User@unfavorite not favorited');
            return false;
        }
    }

    public function is_favorite($messageId)
    {
        $exists = $this->favorites()->where('favorites.message_id', $messageId)->exists();

        Log::info('User@is_favorite', ['messageId' => $messageId, 'exists' => $exists]);

        return $exists;
    }
}
