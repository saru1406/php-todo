<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Memo;

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

        // 検索機能
        $keyword = $request->input('keyword');
        // 自分の投稿した予定のみ検索表示
        $query = Memo::query()->where('user_id', $user->id);
        if(!empty($keyword)) {
            $query->where('title', 'LIKE', "%{$keyword}%")
                ->orWhere('body', 'LIKE', "%{$keyword}%");
        }
        // 自分の投稿した予定のみ表示かつ10件表示
        $memos = $query->paginate(10);
        
        return view('memos.index', compact('user','memos','keyword'));
    }

    public function store(Request $request)
    {
        $user = \Auth::user();
        $memo = new Memo;

        $memo->title = $request->input('title');
        $memo->body = $request->input('body');
        $memo->user_id = $user->id;
        // バリデーション
        $request->validate([
            'title' => 'required|string|max:30',
            'body' => 'required'
        ]);
        $memo->save();

        return redirect()->route('memos.index')->with('flash_message', '投稿が完了しました');
    }

    public function show(int $id)
    {
        $user = \Auth::user();
        $memo = Memo::find($id);

        // 自分の投稿した予定のみに制限
        if($memo->user_id == $user->id){
            return view('memos.show', compact('user', 'memo'));
        }
        else{
            return redirect()->route('memos.index')->with('flash_alert', '他のユーザーの予定は開くことができません');
        }
    }

    public function edit($id)
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

    public function update(Request $request,int $id)
    {
        $user = \Auth::user();
        $memo = Memo::find($id);

        // 自分の投稿した予定のみに変更可能(デベロッパーツールで書き換え対応)
        if ($memo->user_id === $user->id){
            $memo->title = $request->input('title');
            $memo->body = $request->input('body');
            // バリデーション
            $request->validate([
                'title' => 'required|string|max:30',
                'body' => 'required'
            ]);
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
        if ($memo->user_id == $user->id){
            $memo->delete();
            return redirect()->route('memos.index')->with('flash_message', '投稿が削除されました');
        }
        else {
            return redirect()->route('memos.index')->with('flash_alert', '他のユーザーの予定は削除できません');
        }
    }
}