<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\notif;

class NotifController extends Controller
{
    public function index()
    {
        $data = notif::select('notifs.*','users.name','users.username','users.foto')
            ->join('users','users.id','notifs.notify_from')
            ->where('notify_for',auth()->user()->id)
            ->orderby('id','desc')
            ->get();
        notif::where('notify_for',auth()->user()->id)->update(['status'=>true]);
        return view('user.notifikasi',compact('data'));
    }
}
