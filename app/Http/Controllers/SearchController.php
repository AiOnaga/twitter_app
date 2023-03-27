<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TweetPost;
use App\Models\User;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        
        $query = TweetPost::query();
        if (!empty($keyword)) {
            $query->where('caption', 'LIKE', "%{$keyword}%");
        }
        $posts = $query->get();

        $query = User::query();
        if(!empty($keyword)){
            $query->where('name', 'LIKE', "%{$keyword}%");
        }
        $users = $query->get();

        return view('search.index', compact('keyword', 'posts', 'users'));
    }
}
