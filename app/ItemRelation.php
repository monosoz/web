<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemRelation extends Model
{
    //
    protected $fillable = [
        'parent_id', 'child_id', 'item_no',
    ];

    public function childs()
    {
        return $this->belongsToMany('App\Addon', 'child_id');
    }
}
