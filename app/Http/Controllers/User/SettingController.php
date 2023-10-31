<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('user.setting');
    }

    public function email(Request $request)
    {
        auth()->user()->update(['email'=>$request->email]);
        return redirect()->back()->with('success','Email Berhasil diupdate');
    }
    public function password(Request $request)
    {
        auth()->user()->update(['password'=>bcrypt($request->password)]);
        return redirect()->back()->with('success','Password Berhasil diupdate');
    }
}
