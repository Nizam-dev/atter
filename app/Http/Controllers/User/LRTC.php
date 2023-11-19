<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\like;
use App\Models\notif;
use App\Models\postingan;
use App\Models\retweet;
use App\Models\follow;
use App\Models\komentar;
use App\Models\reply;
use App\Models\User;

class LRTC extends Controller
{
    public function like($id)
    {
        $LIKE = like::where('user_id',auth()->user()->id)
        ->where('postingan_id',$id)->first();
        if($LIKE){
            $LIKE->delete();
            notif::where('notify_from',auth()->user()->id)
            ->where('type','like')
            ->where('target',$id)
            ->delete();
        }else{
            like::create(['postingan_id'=>$id,
                'user_id'=>auth()->user()->id
            ]);
            $postingan = postingan::find($id);
            notif::create([
                'notify_for'=>$postingan->user_id,
                'notify_from'=>auth()->user()->id,
                'target'=>$id,
                'type'=>'like',
            ]);
        }
        return response()->json([
            'status' => 'liked'
        ]);
    }

    public function retweet($id)
    {
        $postingan = postingan::find($id);
        $posting = postingan::create(['user_id'=>auth()->user()->id])->id;
        retweet::create([
            'tweet_id'=>$id,
            'postingan_id'=>$posting,
        ]);
        notif::create([
            'notify_for'=>$postingan->user_id,
            'notify_from'=>auth()->user()->id,
            'target'=>$posting,
            'type'=>'retweet',
        ]);
        return redirect()->back()->with('success',"Anda telah me-retweet");
    }


    public function undo_retweet($id)
    {
        $posting = retweet::join('postingans','postingans.id','retweets.postingan_id')
        ->where('retweets.tweet_id',$id)
        ->where('postingans.user_id',auth()->user()->id)->first();
        $postingan_id = $posting->postingan_id;

        retweet::where('postingan_id',$postingan_id)->delete();
        postingan::find($postingan_id)->delete();
        notif::where('type','retweet')
        ->where('target',$postingan_id)
        ->where('notify_from',auth()->user()->id)->delete();
  
        return redirect()->back()->with('success',"Anda telah undo-retweet");
    }
   
    public function quote_retweet($id,Request $request)
    {
        $posting = postingan::create(['user_id'=>auth()->user()->id])->id;
        retweet::create([
            'rtwt'=>$request->rtwt,
            'tweet_id'=>$id,
            'postingan_id'=>$posting,
        ]);
        return redirect()->back()->with('success',"Anda telah me-retweet");
    }

    public function follow($id)
    {
        $cek =  follow::where('follow_id',$id)
        ->where('follower_id',auth()->user()->id)->first();
        if($cek){
            $cek->delete();
            notif::where('notify_for',$id)
            ->where('notify_from',auth()->user()->id)
            ->where( 'type','follow')->delete();
        }else{
            follow::create([
                'follow_id'=>$id,
                'follower_id'=>auth()->user()->id
            ]);
            notif::create([
                'notify_for'=>$id,
                'notify_from'=>auth()->user()->id,
                'target'=>$id,
                'type'=>'follow',
            ]);
        }
    }

    public function komentar($id, Request $request)
    {
        $posting = postingan::find($id);
        komentar::create([
            'comment'=>$request->comment,
            'user_id'=>auth()->user()->id,
            'postingan_id'=>$id
        ]);

        notif::create([
            'notify_for'=>$posting->user_id,
            'notify_from'=>auth()->user()->id,
            'target'=>$id,
            'type'=>'comment',
        ]);
        return redirect()->back()->with('success',"Anda telah menambah komentar");

    }

    public function reply($id, Request $request)
    {
        $komen = komentar::find($id);
        reply::create([
            'replie'=>$request->replie,
            'user_id'=>auth()->user()->id,
            'komentar_id'=>$id
        ]);

        notif::create([
            'notify_for'=>$komen->user_id,
            'notify_from'=>auth()->user()->id,
            'target'=>$komen->postingan_id,
            'type'=>'reply',
        ]);
        return redirect()->back()->with('success',"Anda telah menambah reply");
        
    }
   

    public function search(Request $request)
    {
        $search = $request->search;
        $users = User::
        where(function ($query) use($search) {
            $query->where('username','like','%'.$search.'%')
            ->orWhere('name','like','%'.$search.'%');
        })
        ->where('role','!=','admin')->get();

        $dataresult = ' <div class="nav-right-down-wrap"><ul> ';
        foreach ($users as $user) {
            $dataresult = $dataresult.' 
            <li >
                    <div class="nav-right-down-inner">
                        <div class="nav-right-down-left">
                            <a class="" href="'.$user->username.'"><img class="mt-2 ml-1" src="'.url('public/image/profil/'.$user->foto).'"></a>
                        </div>
                        <div class="nav-right-down-right">
                            <div class="nav-right-down-right-headline">
                                <a class="" href="'.url('/@').$user->username.'">'. $user->name.'</a>
                                <span class="d-block">@'. $user->username.'</span>
                            </div>
                        </div>
                    </div> 
            </li> ';
        }
        $dataresult = $dataresult . ' </ul></div> ';
    
        return response()->json(['data'=>$users,'dataresult'=>$dataresult]);
    }

}