<div class="col-xl-3 offset-xl-1 mt-5">
    <h2>User info</h2>
    <table class="table mt-3">
        <tr>
            <td><h5>name</h5></td>
            <td><h5>{{$user['name']}}</h5></td>
        </tr>
    </table>
    <h2 class="my-5 text-center text-nowrap">予定を入力してください</h2>
    <form method='POST' action="memos">
        @csrf
        <input type='hidden' name='user_id' value="{{ $user['id'] }}">
            <h4>タイトル</h4>
                <textarea name='title' class="form-control bg-white my-3"></textarea>
            <h4>内容</h4>
                <textarea name='body' class="form-control bg-white my-3"></textarea>
            <button type="submit" class="btn btn-success">追加する</button>
        </input>
    </form>
</div>