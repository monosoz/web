<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Amsgames\LaravelShop\Traits\ShopUserTrait;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    use ShopUserTrait;
    protected $fillable = [
        'name', 'email', 'mobile_number', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function locations()
    {
        return $this->hasMany('App\Location');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }
    public function feedbacks()
    {
        return $this->hasMany('App\Feedback');
    }
}
