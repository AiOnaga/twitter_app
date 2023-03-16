<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LDAP\Result;
use App\Models\TweetPost;

class TweetController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $myTweets = $user->tweetPosts->load(['photos', 'user']);

        // 自分($user)がフォローしているユーザーの投稿リストを取得
        // $user->{フォローしているユーザー}->{投稿リスト}
        $followingIds = $user->followings->pluck('id');
        $otherTweets = TweetPost::whereIn('user_id', $followingIds)->with(['user','photos'])->get();
        $tweets = $myTweets->merge($otherTweets)->sortByDesc('created_at');

        return view('tweet.index',compact('tweets'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $tweet = $user->tweetPosts()->create([
            'caption' => $request->get('caption')
        ]);
        
        $file_name = $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public/', $file_name);

        $tweet->photos()->create([
            'image' => 'storage/' .  $file_name
        ]);

        return redirect()->route('tweet.index');

    }
}
