<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Auth;

class LoginRegister extends Controller
{
    public function index()
    {
        if(auth()->check()){
            if(auth()->user()->role == 'admin'){
                return redirect('admin');
            }
            return redirect('home');
        }
        return view('login');
    }
    public function register(Request $request)
    {
        $data = $request->except(['_token']);
        if(User::where('email',$data['email'])->first()){
            return redirect()->back()->with('error',"Gagal, Email Sudah terdaftar");
        }
        $cekUsername =  User::where('name',$data['name'])->count();
        $data['username'] =  $cekUsername == 0 ? Str::slug($data['name']) : Str::slug($data['name'].'-'.$cekUsername);
        $data['password'] = bcrypt($data['password']);
        $data['role'] = 'user';
        User::create($data);
        return redirect()->back()->with('success',"Berhasil Mendaftar Silahkan Login");
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if(auth()->user()->role == 'admin'){
                return redirect('admin')->with('success',"Welcome ".auth()->user()->name);
            }
            return redirect('/home')->with('success',"Welcome ".auth()->user()->name);
        }else{
            return redirect()->back()->with('error','Email atau Password salah');
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/login')->with('success',"God bye");
    }
}
