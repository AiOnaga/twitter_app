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

    public function tweetPosts()
    {
        return $this->hasMany(TweetPost::class);
    }

    public function comments()
    {
        return $this->hasMany(TweetComment::class);
    }

    public function likes()
    {
        return $this->belongsToMany(TweetPost::class,'tweet_likes','user_id', 'post_id','id','id')->withTimestamps()->using(TweetLike::class);
    }
    
    /**
     * followings
     * 自分がフォローしているユーザー一覧取得
     *
     * @return void
     */
    public function followings()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id','followed_id')->withTimestamps()->using(Follow::class);
    }

        
    /**
     * followers
     * 自分をフォローしているユーザー一覧取得
     *
     * @return void
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows','followed_id','following_id')->withTimestamps()->using(Follow::class);
    }

}


