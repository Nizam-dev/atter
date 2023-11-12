<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\postingan;
use App\Models\tweet;
use App\Models\retweet;
use Carbon\Carbon;
class UserController extends Controller
{
    public function index()
    {
        $data = User::where('role','!=','admin')->get();
        return view('admin.user',compact('data'));
    }

    public function edit($id)
    {
        $data = User::findOrFail($id);
        return view('admin.user-edit',compact('data'));
        
    }

    public function update($id, Request $request)
    {
        $data = $request->except(['_token']);
        if($request->hasFile('foto')){
            $tujuan_upload = public_path('image/profil');
            $file = $request->file('foto');
            $namaFile = Carbon::now()->format('Ymd') . $file->getClientOriginalName();
            $file->move($tujuan_upload, $namaFile);
            $data['foto'] = $namaFile;
        }

        $findusername = User::where('id',"!=",$id)->where('username',$data['username'])->first();
        if($findusername){
            return redirect()->back()->with("error","Username ".$data['username']." sudah digunakan");
        }

        if($request->has('password')){
            $data['password'] = bcrypt($data['password']);
        }
        
        User::where("id",$id)->update($data);
        return redirect("admin/user")->with('success','user  telah diedit');
    }

    public function delete($id)
    {
        $postingans = postingan::where('user_id',$id)->get();
        foreach($postingans as $p){
            tweet::where('postingan_id',$p->id)->delete();
            retweet::where('postingan_id',$p->id)->delete();
            retweet::where('tweet_id',$p->id)->delete();
        }
        User::find($id)->delete();
        return redirect("admin/user")->with('success','user telah dihapus');
    }
}
