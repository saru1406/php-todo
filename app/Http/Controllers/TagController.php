<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function store(Request $request)
    {
        $user = \Auth::user();
        $tag = new Tag;

        $tag->name = $request->input('name');
        $tag->user_id = $user->id;
        // バリデーション
        $request->validate([
            'tag' => 'required|string|max:10',
        ]);
        $tag->save();

        return redirect()->route('memos.index')->with('flash_message', '投稿が完了しました');
    }
}
