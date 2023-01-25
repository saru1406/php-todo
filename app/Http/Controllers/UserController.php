<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
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

    public function update(AuthRequest $request)
    {
        $user = \Auth::user();

        $user->name = $request->input('name');
        $user->save();
        
        return redirect()->route('memos.index')->with('flash_message', '変更されました');
    }

    public function destroy()
    {
        $user = \Auth::user()->delete();

        return redirect('/')->with('flash_message', '退会されました');
    }
}