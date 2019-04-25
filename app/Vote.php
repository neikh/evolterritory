<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    public $timestamps = false;
    protected $fillable = ['sun','cloud'];

    public function post()
    {
        return $this->hasOne('Post');
    }
}
