<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookmark;
use App\Models\Memo;

class BookmarkController extends Controller
{
    public function store(Request $request)
    {
        $user = \Auth::user();

        $bookmark = new Bookmark;
        $bookmark->user_id = $user->id;
        $bookmark->memo_id = $request->input('memo_id');
        $bookmark->save();

        return back();
    }

    public function destroy(int $id)
    {
        $user = \Auth::user();

        $memo = Memo::find($id);
        $memo->bookmarks()->delete();

        return back();
    }
}
