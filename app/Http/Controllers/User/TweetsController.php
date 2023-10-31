<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\postingan;
use App\Models\tends;
use App\Models\tweet;
use Carbon\Carbon;

class TweetsController extends Controller
{
    public function post(Request $request)
    {
        $data = $request->except(['_token']);
        if($request->hasFile('img')){
            $tujuan_upload = public_path('image/post');
            $file = $request->file('img');
            $namaFile = Carbon::now()->format('Ymd') . $file->getClientOriginalName();
            $file->move($tujuan_upload, $namaFile);
            $data['img'] = $namaFile;
        }
        
        $id_post = postingan::create(['user_id'=>auth()->user()->id])->id;
        $data['postingan_id'] = $id_post;
        tweet::create($data);
        $hastag = $this->findHastag($data['tweet']);
        foreach($hastag[1] as $h){
            if(!tends::where('hastag',$h)->first()){
                tends::create(['hastag'=>$h]);
            }
        }
        return redirect()->back()->with('success','Tweet baru telah diposting');
            
    }

    public function findHastag($text)
    {
        preg_match_all('/#(\w+)/', $text, $allMatches);
        return $allMatches;
    }
}
