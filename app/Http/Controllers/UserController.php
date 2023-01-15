<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    public function edit()
    {
        $user = \Auth::user();
        return view('mypage', compact('user'));
    }

    public function update(Request $request)
    {
        $user = \Auth::user();
        dd($user);
    }
}
