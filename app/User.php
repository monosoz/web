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
        'name', 'email', 'mobile_number', 'password', 'address', 'location',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
