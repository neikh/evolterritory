<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function vote()
    {
        return $this->hasMany('Vote');
    }
}
