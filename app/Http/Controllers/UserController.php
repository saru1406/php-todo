<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    public function edit()
    {
        $user = \Auth::user();
        return view('users.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = \Auth::user();
        $user->name = $request->input('name');
        $user->save();
        
        return redirect()->route('memos.index');
    }
}
