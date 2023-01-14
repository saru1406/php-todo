@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-5 mx-auto text-center mt-5">
            <h2 class="mb-5">予定を入力してください</h2>
            <form method='POST' action="memos">
                @csrf
                <h4>タイトル</h4>
                <input type='hidden' name='user_id' value="{{ $user['id'] }}">
                <div class="form-group">
                    <textarea name='title' class="form-control bg-white"></textarea>
                </div>
                <h4>内容</h4>
                <div class="form-group">
                    <textarea name='body' class="form-control bg-white"></textarea>
                </div>
                <button type="submit" class="btn btn-success">追加する</button>
            </form>
        </div>
    </div>
</div>
@endsection