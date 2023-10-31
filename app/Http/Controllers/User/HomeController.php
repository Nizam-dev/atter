<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\postingan;

class HomeController extends Controller
{
    public function index()
    {

        $data = postingan::select('postingans.id','postingans.user_id','tweets.tweet','tweets.img','retweets.rtwt','retweets.tweet_id','users.username','users.name','users.foto','postingans.created_at')
        ->join('users','users.id','postingans.user_id')
        ->leftJoin('tweets','tweets.postingan_id','postingans.id')
        ->leftJoin('retweets','retweets.postingan_id','postingans.id')
        ->orderby('id','DESC')
        ->with(['likes','retweet','komentar'])
        ->get();
        foreach($data as $d){
            if($d->tweet_id){
                $d->data_rtwt = postingan::select('postingans.id','postingans.user_id','tweets.tweet','tweets.img','users.username','users.name','users.foto','postingans.created_at')
                ->where('postingans.id',$d->tweet_id)
                ->join('users','users.id','postingans.user_id')
                ->leftJoin('tweets','tweets.postingan_id','postingans.id')
                ->first();
            }
        }

        // dd($data);

        return view('user.home',compact('data'));
    }
}
