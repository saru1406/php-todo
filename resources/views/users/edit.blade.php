@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="col-xl-5 mx-auto mt-5">
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
        <h2 class="my-5 text-center text-nowrap">ユーザー情報を編集</h2>
        <form method="POST" action="{{route('user.update')}}">
            @csrf
            @method('PATCH')
            <table class="table table-borderless">
                <tr>
                    <td><h4>name</h4></td>
                    <td><textarea name='name' class="form-control bg-white" rows="1" placeholder="20文字以内で入力してください">{{ $user['name']}}</textarea></td>
                    <td><button type="submit" class="btn btn-success">変更する</button></td>
                </tr>
            </table>
        </form>
        <div class="mt-5 text-center">
            <form method='POST' action="{{route('user.destroy')}}">
            @csrf
            @method('DELETE')
                <button type="submit" class="btn btn-danger w-25 text-nowrap" onclick="return confirm('本当に退会しますか？')">退会</button>
            </form>
        </div>
    </div>
</div>
@endsection