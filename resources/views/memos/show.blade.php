@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-xl-3 d-none d-xl-block offset-xl-1 mt-5">
            <!-- バリデーションメッセージ -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <h2>User info</h2>
            <table class="table mt-3">
                <tr>
                    <td><h5>name</h5></td>
                    <td><h5>{{$user['name']}}</h5></td>
                </tr>
            </table>
            <div class="d-grid gap-2 col-6 mx-auto">
                <a class="btn btn-outline-secondary btn", href="{{ route('user.edit')}}">ユーザー情報編集</a>
            </div>
            <h2 class="my-5 text-center text-nowrap">予定を入力してください</h2>
            <form method='POST' action="{{ route('memos.store')}}">
                @csrf
                <h4>タイトル</h4>
                <textarea name='title' class="form-control bg-white my-3" rows="1" placeholder="30文字以内で入力してください">{{old('title')}}</textarea>
                <h4>内容</h4>
                <textarea name='body' class="form-control bg-white my-3" rows="5" placeholder="内容を入力してください">{{old('body')}}</textarea>
                <button type="submit" class="btn btn-success">追加する</button>
            </form>
        </div>
        <div class="col-xl-5 offset-xl-1 mt-5">
            <h2 class="text-center">予定詳細</h2>
            <div class="card border-warning mb-4 text-center shadow" style="max-width: 100%;">
                <div class="card-header">{{ $memo->title }}</div>
                <div class="card-body">
                    <p class="card-text">{!! nl2br(e($memo->body)) !!}</p>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-xl-6">
                    <a href="{{ route('memos.edit',($memo->id)) }}", class="btn btn-primary text-nowrap">編集</a>
                </div>
                <div class="col-xl-6">
                    <form method='POST' action="{{ route('memos.destroy',($memo->id)) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger text-nowrap">削除</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection