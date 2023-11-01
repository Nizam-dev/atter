<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\postingan;
use Carbon\Carbon;
class ProfilController extends Controller
{
    public function index($username)
    {
        $user = User::where('username',$username)->with(['followings','followers'])->first();
        if(!$user){
            return abort(404);
        }

        $data = postingan::select('postingans.id','postingans.user_id','tweets.tweet','tweets.img','retweets.rtwt','retweets.tweet_id','users.username','users.name','users.foto','postingans.created_at')
        ->join('users','users.id','postingans.user_id')
        ->leftJoin('tweets','tweets.postingan_id','postingans.id')
        ->leftJoin('retweets','retweets.postingan_id','postingans.id')
        ->orderby('id','DESC')
        ->with(['likes','retweet'])
        ->where('user_id',$user->id)
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

        $datalikes = postingan::select('postingans.id','postingans.user_id','tweets.tweet','tweets.img','retweets.rtwt','retweets.tweet_id','users.username','users.name','users.foto','postingans.created_at')
        ->join('users','users.id','postingans.user_id')
        ->Join('likes','likes.postingan_id','postingans.id')
        ->leftJoin('tweets','tweets.postingan_id','postingans.id')
        ->leftJoin('retweets','retweets.postingan_id','postingans.id')
        ->orderby('id','DESC')
        ->with(['likes','retweet'])
        ->where('likes.user_id',$user->id)
        ->get();
        foreach($datalikes as $d){
            if($d->tweet_id){
                $d->data_rtwt = postingan::select('postingans.id','postingans.user_id','tweets.tweet','tweets.img','users.username','users.name','users.foto','postingans.created_at')
                ->where('postingans.id',$d->tweet_id)
                ->join('users','users.id','postingans.user_id')
                ->leftJoin('tweets','tweets.postingan_id','postingans.id')
                ->first();
            }
        }

        if(!auth()->check()){
            $followers = User::select('users.*')
            ->join('follows','follower_id','users.id')
            ->where('follows.follow_id',$user->id)
            ->with(['followers','followings'])
            ->get();
    
            $following = User::select('users.*')
            ->join('follows','follow_id','users.id')
            ->where('follows.follower_id',$user->id)
            ->with(['followers','followings'])
            ->get();
            return view('guest.profile',compact('data','user','followers','following','datalikes'));
        }
        $followers = User::select('users.*')
        ->where('users.id','!=',auth()->user()->id)
        ->join('follows','follower_id','users.id')
        ->where('follows.follow_id',$user->id)
        ->with(['followers','followings'])
        ->get();

        $following = User::select('users.*')
        ->where('users.id','!=',auth()->user()->id)
        ->join('follows','follow_id','users.id')
        ->where('follows.follower_id',$user->id)
        ->with(['followers','followings'])
        ->get();

        
        return view('user.profile',compact('data','user','followers','following','datalikes'));
    }

    public function update(Request $request)
    {
        $data = $request->except(['_token']);
        if($request->hasFile('foto')){
            $tujuan_upload = public_path('image/profil');
            $file = $request->file('foto');
            $namaFile = Carbon::now()->format('Ymd') . $file->getClientOriginalName();
            $file->move($tujuan_upload, $namaFile);
            $data['foto'] = $namaFile;
        }
        if($request->hasFile('bg')){
            $tujuan_upload = public_path('image/profil');
            $file = $request->file('bg');
            $namaFile = Carbon::now()->format('Ymd') . $file->getClientOriginalName();
            $file->move($tujuan_upload, $namaFile);
            $data['bg'] = $namaFile;
        }

        auth()->user()->update($data);
        return redirect()->back()->with('success','Profil Berhasil diupdate');
        
    }
}
