<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusCode extends Model
{

	protected $table = 'order_status';
    protected $primaryKey = 'code'; // or null

    public $incrementing = false;

    public function orders()
    {
        return $this->hasOne('App\Order', 'statusCode');
    }
}
