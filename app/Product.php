<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    public function variants()
    {
        return $this->hasMany('App\Variant');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
}
