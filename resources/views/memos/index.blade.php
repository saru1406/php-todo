@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-3 offset-xl-1 mt-5">
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
            <form method='POST' action="memos">
                @csrf
                <input type='hidden' name='user_id' value="{{ $user['id'] }}">
                    <h4>タイトル</h4>
                        <textarea name='title' class="form-control bg-white my-3" rows="1"></textarea>
                    <h4>内容</h4>
                        <textarea name='body' class="form-control bg-white my-3" rows="5"></textarea>
                    <button type="submit" class="btn btn-success mb-3">追加する</button>
                </input>
            </form>
        </div>
        <div class="col-xl-5 offset-xl-1">
            <form action="{{ route('memos.index') }}" method="GET">
                <div class="row">
                    <div class="col-xl-8">
                        <input type="text" class="form-control mx-auto bg-white" name="keyword" value="{{ $keyword }}">
                    </div>
                    <div class="col-xl-4 d-flex align-items-center">
                        <input type="submit" value="検索">
                    </div>
                </div>
            </form>
            <h2 class="text-center mt-5">予定一覧</h2>
            <!-- @foreach ($memos as $memo)
            <a href="memos/{{ $memo['id'] }}" style="text-decoration:none;" class="text-dark">
                <div class="card border-warning mb-4 text-center shadow" style="max-width: 100%;">
                    <div class="card-header">タイトル:{{ $memo->title }}</div>
                    <div class="card-body">
                        <p class="card-text">{{ $memo->body }}</p>
                    </div>
                </div>
            </a>
            @endforeach -->
            <table class="table table-hover table-inverse">
                <tr>
                    <th>タイトル</th>
                    <th>内容</th>
                </tr>
                    @foreach ($memos as $memo)
                        <tr>
                            <td><a href="memos/{{ $memo['id'] }}" style="text-decoration:none;" class="text-nowrap">{{ $memo->title }}</a></td>
                            <td>{{ $memo->body }}</td>
                        </tr>
                    @endforeach
            </table>
        </div>
    </div>
</div>
@endsection