<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MemoRequest;
use App\Models\Memo;
use App\Models\Tag;
use App\Models\Bookmark;

class MemoController extends Controller
{
    // ログイン制限
    public function __construct()
    {
        $this->middleware('auth');
    }
 
    public function index(Request $request)
    {
        $user = \Auth::user();
        $tags = $user->tags;
        
        // キーワード検索機能
        $keyword = $request->input('keyword');
        // タグ検索
        $tag_keyword = $request->input('tag_keyword');
        // 自分の投稿した予定のみ検索表示
        $query = Memo::query()->where('user_id', $user->id);
        if(!empty($keyword)) {
            $query->where('title', 'LIKE', "%{$keyword}%")
                ->orWhere('body', 'LIKE', "%{$keyword}%");
        }
        // タグ検索
        elseif(!empty($tag_keyword)) {
            $query->WhereHas('tag', function ($query) use ($tag_keyword){
                $query->where('name', 'LIKE', "{$tag_keyword}");
            });
        }
        // ページネーション10件表示
        $memos = $query->paginate(10);
        
        return view('memos.index', compact('user','memos','keyword','tags','tag_keyword'));
    }

    public function store(MemoRequest $request)
    {
        $user = \Auth::user();

        $memo = new Memo;
        $memo->title = $request->input('title');
        $memo->body = $request->input('body');
        $memo->user_id = $user->id;
        $memo->tag_id = $request->input('tag_id');
        $memo->save();

        return redirect()->route('memos.index')->with('flash_message', '投稿が完了しました');
    }

    public function show(int $id)
    {
        $user = \Auth::user();
        $memo = Memo::find($id);
        $bookmark = Bookmark::where('memo_id', $memo->id)->where('user_id', $user->id)->first();

        // 自分の投稿した予定のみに制限
        if($memo->user_id === $user->id){
            return view('memos.show', compact('user', 'memo','bookmark'));
        }
        else{
            return redirect()->route('memos.index')->with('flash_alert', '他のユーザーの予定は開くことができません');
        }
    }

    public function edit(int $id)
    {
        $user = \Auth::user();
        $memo = Memo::find($id);

        // 自分の投稿した予定のみに制限
        if($memo->user_id === $user->id){
            return view('memos.edit', compact('user', 'memo'));
        }
        else{
            return redirect()->route('memos.index')->with('flash_alert', '他のユーザーの予定は開くことができません');
        }
    }

    public function update(MemoRequest $request,int $id)
    {
        $user = \Auth::user();
        $memo = Memo::find($id);

        // 自分の投稿した予定のみに変更可能(デベロッパーツールで書き換え対応)
        if ($memo->user_id === $user->id){
            $memo->title = $request->input('title');
            $memo->body = $request->input('body');
            $memo->save();
            return redirect()->route('memos.show', $id)->with('flash_message', '変更されました');
        }
        else {
            return redirect()->route('memos.index')->with('flash_alert', '他のユーザーの予定は変更できません');
        }        
    }

    public function destroy(int $id)
    {
        $user = \Auth::user();
        $memo = Memo::find($id);

        // 自分の投稿した予定のみに削除可能(デベロッパーツールで書き換え対応)
        if ($memo->user_id === $user->id){
            $memo->delete();
            return redirect()->route('memos.index')->with('flash_message', '投稿が削除されました');
        }
        else {
            return redirect()->route('memos.index')->with('flash_alert', '他のユーザーの予定は削除できません');
        }
    }
}