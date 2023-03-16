<?php

namespace App\Http\Controllers;

use App\Models\TweetPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function show(int $userId)
    {
        $me = Auth::user();
        $isFollowing = $me->followings->firstWhere('id', $userId);

        // $userがtrue && $user->idと$userIdが一致 ==>> $user->tweetPosts;
        if($me && $me->id == $userId){
            $user = $me;
            $tweets = $me->tweetPosts;
        }else{
            $user = User::find($userId);
            $tweets = $user->tweetPosts;
        }

        // $user = Auth::user() && Auth::id() == $userId ? Auth::user() : User::find($userId);
        // $tweets = $user->tweetPosts;

        return view('user.show',compact('tweets', 'user','isFollowing','me'));
    }


    public function tweet(int $userId, int $postId)
    {
        $user = Auth::user();

        $tweet = TweetPost::with(['user','comments'])->find($postId);

        return view('user.tweet_show',compact('user','tweet'));

    }

    public function follow(Request $request, int $userId)
    {
        $user = Auth::user();

        $follow = $user->followings()->attach($userId);

        return redirect()->route('user.show', ['userId'=>$userId]);
    }

    public function unfollow(int $userId)
    {
        $user = Auth::user();

        $unfollow = $user->followings()->detach($userId);

        return redirect()->route('user.show', ['userId'=>$userId]);
        
    }


}