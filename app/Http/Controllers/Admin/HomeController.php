<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\postingan;
use App\Models\komentar;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'komentar' => komentar::count(),
            'postingan' => postingan::count(),
            'user' => User::count(),
        ];
        return view('admin.home',compact('data'));
    }
}
