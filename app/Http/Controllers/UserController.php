<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    // ログイン制限
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function edit()
    {
        $user = \Auth::user();

        return view('users.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = \Auth::user();

        $user->name = $request->input('name');
        // バリエーション
        $request->validate([
            'name' => 'required|string|max:20'
        ]);
        $user->save();
        
        return redirect()->route('memos.index')->with('flash_message', '変更されました');
    }
}