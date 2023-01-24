@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="col-xl-6 mx-auto">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h2>タグ追加</h2>
        <form method='POST' action="{{ route('tags.store')}}">
            @csrf
            <textarea name='name' class="form-control bg-white my-3" rows="1" placeholder="10文字以内で入力してください">{{ old('name') }}</textarea>
            <button type="submit" class="btn btn-success mb-3">追加する</button>
        </form>
    </div>
</div>
@endsection