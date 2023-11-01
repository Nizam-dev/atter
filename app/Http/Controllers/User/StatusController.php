<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\postingan;

class StatusController extends Controller
{
    public function index($id)
    {
        $tweet = postingan::select('postingans.id','postingans.user_id','tweets.tweet','tweets.img','retweets.rtwt','retweets.tweet_id','users.username','users.name','users.foto','postingans.created_at')
        ->join('users','users.id','postingans.user_id')
        ->leftJoin('tweets','tweets.postingan_id','postingans.id')
        ->leftJoin('retweets','retweets.postingan_id','postingans.id')
        ->orderby('id','DESC')
        ->with(['likes','retweet','komentar'])
        ->where('postingans.id',$id)
        ->first();
        if(!$tweet){
            return abort(404);
        }
        if($tweet->tweet_id){
            $tweet->data_rtwt = postingan::select('postingans.id','postingans.user_id','tweets.tweet','tweets.img','users.username','users.name','users.foto','postingans.created_at')
            ->where('postingans.id',$tweet->tweet_id)
            ->join('users','users.id','postingans.user_id')
            ->leftJoin('tweets','tweets.postingan_id','postingans.id')
            ->first();
        }
        if(!auth()->check()){
            return view('guest.status',compact('tweet'));
        }
        return view('user.status',compact('tweet'));
    }
}
