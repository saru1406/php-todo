<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
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

        // バリエーション
        $request->validate([
            'name' => 'required'
        ],
         [
                'name.required' => 'nameは必須です。'
         ]);

        $user->name = $request->input('name');
        $user->save();
        
        return redirect()->route('memos.index');
    }
}
