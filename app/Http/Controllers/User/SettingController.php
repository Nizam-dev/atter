<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class SettingController extends Controller
{
    public function index()
    {
        return view('user.setting');
    }

    public function email(Request $request)
    {
        $findusername = User::where('username',$request->username)->where('id','!=',auth()->user()->id)->first();
        if($findusername){
            return redirect()->back()->with('error',"Username Telah digunakan silahkan cari username lain");
        }
        auth()->user()->update(['email'=>$request->email,'username'=>$request->username]);
        return redirect()->back()->with('success','Email Berhasil diupdate');
    }
    public function password(Request $request)
    {
        auth()->user()->update(['password'=>bcrypt($request->password)]);
        return redirect()->back()->with('success','Password Berhasil diupdate');
    }
}
