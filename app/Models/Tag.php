<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //userモデル　リレーション
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function memo()
    {
        return $this->hasOne('App\Models\Memo');
    }
}
