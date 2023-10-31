<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tweet;

class TweetController extends Controller
{
    public function index()
    {
        $data = tweet::select('tweets.*','users.username')
        ->join('postingans','postingans.id','tweets.postingan_id')
        ->join('users','users.id','postingans.user_id')
        ->get();
        return view('admin.tweet',compact('data'));
    }
}
