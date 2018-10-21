<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserOrder extends Model
{
    protected $fillable = [
        'user_id', 'status', 'sum_total', 'date',
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function userMenu(){
        return $this->hasMany('App\UserMenu ');
    }
}
