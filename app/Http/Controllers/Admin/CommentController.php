<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\komentar;

class CommentController extends Controller
{
    public function index()
    {
        $data = komentar::select('komentars.*','to.username as to','from.username as from')
        ->join('postingans','postingans.id','komentars.postingan_id')
        ->join('users as to','to.id','postingans.user_id')
        ->join('users as from','from.id','komentars.user_id')
        ->get();
        return view('admin.komentar',compact('data'));
    }

    public function edit($id)
    {
       $data = komentar::findOrFail($id);
       return view('admin.komentar-edit',compact('data'));
    }

    public function update($id, Request $request)
    {
        komentar::where("id",$id)->update(['comment'=>$request->comment]);
        return redirect("admin/comments")->with('success','Komentar  telah diedit');
    }
    public function delete($id)
    {
        komentar::where("id",$id)->delete();
        return redirect("admin/comments")->with('success','Komentar  telah dihapus');
    }
}
