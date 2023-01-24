<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function index()
    {
        $user = \Auth::user();
        $tag = $user->tags;

        return view('tags.index', compact('user','tag'));
    }

    public function edit(int $id)
    {
    }

    public function store(Request $request)
    {
        $user = \Auth::user();

        $tag = new Tag;
        $tag->name = $request->input('name');
        $tag->user_id = $user->id;
        // バリデーション
        $request->validate([
            'name' => 'required|string|max:10',
        ]);
        $tag->save();

        return redirect()->route('tags.index')->with('flash_message', '投稿が完了しました');
    }

    public function update(Request $request,int $id)
    {
    }

    public function destroy(int $id)
    {
    }
}
