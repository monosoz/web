<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
	protected $fillable = [
        'name', 'mobile_number', 'pincode', 'address', 'lat', 'lng', 'usercomment', 'comment',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
