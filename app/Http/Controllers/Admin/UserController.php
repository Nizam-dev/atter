<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    public function index()
    {
        $data = User::where('role','!=','admin')->get();
        return view('admin.user',compact('data'));
    }
}
