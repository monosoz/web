<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuestItemRelation extends Model
{
    //
    protected $fillable = [
        'parent_id', 'child_id', 'item_no',
    ];

    public function child()
    {
        return $this->belongsTo('App\Addon', 'child_id');
    }
}
