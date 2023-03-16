<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TweetPost extends Model
{
    use HasFactory;

    protected $table = 'tweet_posts';

    protected $fillable = [
        'caption',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(TweetComment::class, 'post_id');
    }

    public function likes()
    {
        return $this->hasManyThrough(User::class,TweetLike::class, 'post_id','user_id','id','id');
    }

    public function photos()
    {
        return $this->hasMany(TweetPhoto::class,'post_id');
    }
}
