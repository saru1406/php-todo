<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Memo;

class MemoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();
        // 自分の投稿した予定のみ表示
        $memos = Memo::where('user_id', $user->id)->get();
        
        return view('memos.index', compact('user','memos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('memos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $memo=new Memo;

        $memo->title=$request->input('title');
        $memo->body=$request->input('body');
        $memo->user_id=$request->input('user_id');
        $memo->save();

        return redirect()->route('memos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = \Auth::user();
        // 自分の投稿した予定のみに制限
        $memo = Memo::where('user_id', $user->id)->find($id);

        return view('memos.show', compact('user','memo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = \Auth::user();
        // 自分の投稿した予定のみに制限
        $memo = Memo::where('user_id', $user->id)->find($id);

        return view('memos.edit', compact('user', 'memo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = \Auth::user();
        $memo = Memo::find($id);

        $memo->title=$request->input('title');
        $memo->body=$request->input('body');
        $memo->save();

        return view('memos.show', compact('user','memo'));
        return redirect()->route('memos.show');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = \Auth::user();
        // 自分の投稿した予定のみに制限
        $memo = Memo::where('user_id', $user->id)->find($id)->delete();

        return redirect()->route('memos.index');
    }
}
