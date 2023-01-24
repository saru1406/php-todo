<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function index()
    {
        $user = \Auth::user();
        $tags = $user->tags;

        return view('tags.index', compact('user','tags'));
    }

    public function edit(int $id)
    {
        $user = \Auth::user();
        $tag = Tag::find($id);

        return view('tags.edit', compact('user','tag'));
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
        $user = \Auth::user();
        $tag = Tag::find($id);

        if ($tag->user_id === $user->id){
            $tag->name = $request->input('name');
            $tag->save();
            return redirect()->route('tags.index')->with('flash_message', '変更が完了しました');
        }
        else{
            return redirect()->route('tags.index')->with('flash_message', '他のユーザーのタグは変更できません');
        }
    }

    public function destroy(int $id)
    {
        $tag = Tag::find($id);
        $user = \Auth::user();

        if ($tag->user_id === $user->id){
            $tag->delete();
            return redirect()->route('tags.index')->with('flash_message', '削除されました');
        }
        else{
            return redirect()->route('tags.index')->with('flash_alert', '他のユーザーのタグは削除できません');
        }
    }
}
