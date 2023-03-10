@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="col-xl-5 mx-auto mt-5">
        <!-- バリエーションメッセージ -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h2 class="my-5 text-center text-nowrap">予定を編集</h2>
        <form method='POST' action="{{route('memos.update',($memo->id))}}">
            @csrf
            @method('PATCH')
                    <h4>タイトル</h4>
                    <textarea name='title' class="form-control bg-white my-3" rows="1" placeholder="30文字以内で入力してください">{{ $memo['title']}}</textarea>
                    <h4>内容</h4>
                    <textarea name='body' class="form-control bg-white my-3" rows="5" placeholder="内容を入力してください">{{ $memo['body']}}</textarea>
                    <button type="submit" class="btn btn-success">変更する</button>
                </input>
        </form>
    </div>
</div>
@endsection