@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-xl-3 offset-xl-1 mt-5">
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
            <form method='POST' action="memos">
                @csrf
                <h4>タイトル</h4>
                <!-- バリエーションエラー時の入力値保持{{ old('title') }} -->
                <textarea name='title' class="form-control bg-white my-3" rows="1" placeholder="30文字以内で入力してください">{{ old('title') }}</textarea>
                <h4>内容</h4>
                <!-- バリエーションエラー時の入力値保持{{ old('body') }} -->
                <textarea name='body' class="form-control bg-white my-3" rows="5" placeholder="内容を入力してください">{{ old('body') }}</textarea>
                <h4>タグ</h4>
                <textarea name='name' class="form-control bg-white my-3" rows="1" placeholder="タグを追加してください">{{ old('name') }}</textarea>
                <button type="submit" class="btn btn-success mb-3">追加する</button>
            </form>
        </div>
        <div class="col-xl-5 offset-xl-1">
            <form action="{{ route('memos.index') }}" method="GET">
                <div class="row">
                    <div class="col-xl-8">
                        <input type="text" class="form-control mx-auto bg-white" name="keyword" value="{{ $keyword }}" placeholder="キーワードを入力してください">
                    </div>
                    <div class="col-xl-4 d-flex align-items-center">
                        <input type="submit" value="検索">
                    </div>
                </div>
            </form>
            <h2 class="text-center mt-5">予定一覧</h2>
            <table class="table table-hover table-inverse">
                <tr>
                    <th>タイトル</th>
                    <th>内容</th>
                </tr>
                    @foreach ($memos as $memo)
                        <tr>
                            <td><a href="{{route('memos.show',($memo->id))}}" style="text-decoration:none;" class="text-nowrap">{{ $memo->title }}</a></td>
                            <td>
                                <!-- 内容が50文字以上であれば【続きを表示】 -->
                                @if(mb_strlen($memo->body) > 50)
                                    {!! nl2br(e(Str::limit($memo->body, 50))) !!}<a href="{{route('memos.show',($memo->id))}}" style="text-decoration:none;">【続きを表示】</a>
                                @else
                                    {!! nl2br(e($memo->body)) !!}
                                @endif
                            </td>
                        </tr>
                    @endforeach
            </table>
            {!! $memos->appends(request()->query())->links() !!}
        </div>
    </div>
</div>
@endsection