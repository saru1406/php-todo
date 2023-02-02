@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mt-5">お気に入り一覧</h2>
    <table class="table table-hover table-inverse">
        <tr>
            <th>タイトル</th>
            <th>内容</th>
            <th>タグ</th>
        </tr>
        @foreach ($bookmarks as $bookmark)
            <tr>
                <td><a href="{{route('memos.show',($bookmark->memo->id))}}" style="text-decoration:none;" class="text-nowrap">{{ $bookmark->memo->title }}</a></td>
                <td>
                    <!-- 内容が50文字以上であれば【続きを表示】 -->
                    @if(mb_strlen($bookmark->memo->body) > 50)
                        {!! nl2br(e(Str::limit($bookmark->memo->body, 50))) !!}<a href="{{route('memos.show',($bookmark->memo->id))}}" style="text-decoration:none;">【続きを表示】</a>
                    @else
                        {!! nl2br(e($bookmark->memo->body)) !!}
                    @endif
                </td>
                <td>
                    @if (isset($bookmark->memo->tag_id))
                        {{ $bookmark->memo->tag->name }}
                    @endif
                </td> 
            </tr>
        @endforeach
    </table>
    {!! $bookmarks->appends(request()->query())->links() !!}
</div>
@endsection