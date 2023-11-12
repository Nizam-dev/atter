<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tweet;
use App\Models\retweet;
use App\Models\like;
use App\Models\postingan;
use Carbon\Carbon;


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

    public function edit($id)
    {
        $data = tweet::findOrFail($id);
        return view('admin.tweet-edit',compact('data'));
        
    }

    public function update($id, Request $request)
    {
        $data = $request->except(['_token']);
        if($request->hasFile('img')){
            $tujuan_upload = public_path('image/post');
            $file = $request->file('img');
            $namaFile = Carbon::now()->format('Ymd') . $file->getClientOriginalName();
            $file->move($tujuan_upload, $namaFile);
            $data['img'] = $namaFile;
        }
        
        tweet::where("id",$id)->update($data);
        return redirect("admin/tweet")->with('success','Tweet baru telah diedit');
    }

    public function delete($id)
    {
        like::where('postingan_id',$id)->delete();
        retweet::where('tweet_id',$id)->delete();
        tweet::where('postingan_id',$id)->delete();
        postingan::where('id',$id)->delete();
        return redirect("admin/tweet")->with('success','Tweet baru telah dihapus');
    }
}
