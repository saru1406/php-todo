<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// sorttable
use Kyslik\ColumnSortable\Sortable;

class Memo extends Model
{
    use HasFactory;

    //userモデル　リレーション
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function tag()
    {
        return $this->belongsTo('App\Models\Tag');
    }

    public function bookmarks()
    {
        return $this->hasMany('App\Models\Bookmark');
    }

    use Sortable;
    public $sortable = ['created_at', 'updated_at'];
}