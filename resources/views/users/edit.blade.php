@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="col-xl-5 mx-auto mt-5">
        <h2 class="my-5 text-center text-nowrap">ユーザー情報を編集</h2>
        <form method="POST" action="{{route('user.update')}}">
            @csrf
            @method('PATCH')
                <table class="table table-borderless">
                    <tr>
                        <td><h4>name</h4></td>
                        <td><textarea name='name' class="form-control bg-white" rows="1">{{ $user['name']}}</textarea></td>
                        <td><button type="submit" class="btn btn-success">変更する</button></td>
                    </tr>
                </table>
        </form>
    </div>
</div>
@endsection