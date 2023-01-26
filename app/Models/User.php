<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
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
    ];

    // Memoモデル　リレーション
    public function memos()
    {
        return $this->hasMany('App\Models\Memo');
    }

    // Tagモデル　リレーション
    public function tags()
    {
        return $this->hasMany('App\Models\Tag');
    }

    public function bookmarks()
    {
        return $this->hasMany('App\Models\Bookmark');
    }

    // userが削除されると紐づいているメモも削除
    public static function boot()
    {
    parent::boot();
        static::deleted(function ($user) {
            $user->memos()->delete();
        });
    }
}
