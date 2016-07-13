<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
	protected $fillable = [
        'address', 'lat', 'lng', 'comment',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
