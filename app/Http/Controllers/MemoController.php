<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Memo;

class MemoController extends Controller
{
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
        // 自分の投稿した予定のみ表示
        $memos = $query->where('user_id', $user->id)->get();

        return view('memos.index', compact('user','memos','keyword'));
    }

    public function create()
    {
        return view('memos.create');
    }

    public function store(Request $request)
    {
        $memo=new Memo;

        $memo->title = $request->input('title');
        $memo->body = $request->input('body');
        $memo->user_id = $request->input('user_id');
        $memo->save();

        return redirect()->route('memos.index');
    }

    public function show($id)
    {
        $user = \Auth::user();
        // 自分の投稿した予定のみに制限
        $memo = Memo::where('user_id', $user->id)->find($id);

        return view('memos.show', compact('user','memo'));
    }

    public function edit($id)
    {
        $user = \Auth::user();
        // 自分の投稿した予定のみに制限
        $memo = Memo::where('user_id', $user->id)->find($id);

        return view('memos.edit', compact('user', 'memo'));
    }

    public function update(Request $request, $id)
    {
        $user = \Auth::user();
        $memo = Memo::find($id);

        $memo->title = $request->input('title');
        $memo->body = $request->input('body');
        $memo->save();

        return view('memos.show', compact('user','memo'));
        return redirect()->route('memos.show');
    }

    public function destroy($id)
    {
        $user = \Auth::user();
        // 自分の投稿した予定のみに制限
        $memo = Memo::where('user_id', $user->id)->find($id)->delete();

        return redirect()->route('memos.index');
    }
}
