@extends('layouts.app')

@section('content')
<div class="main-visual">
</div>
<div class="bg-dark text-white">
    <div class="img-body text-center py-3">
        <h4>Todoアプリ</h4>
        <h5>予定が管理できるサイト</h5>
    </div>
</div>
@guest
    <div class="container mt-5">
        <div class="row">
            <div class="col-xl-4 mx-auto text-center">
                <a class="btn btn-success btn-lg w-100" href="{{ route('login') }}">{{ __('ログイン') }}</a>
            </div>
            <div class="col-xl-4 mx-auto text-center">
                <a class="btn btn-primary btn-lg w-100" href="{{ route('register') }}">{{ __('新規登録') }}</a>
            </div>
        </div>
    </div>
@endguest
@endsection