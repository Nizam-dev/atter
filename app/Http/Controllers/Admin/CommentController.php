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
}
