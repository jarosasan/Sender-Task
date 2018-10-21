<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'price_total', 'confirmed', 'user_id'
    ];

    public function plan()
    {
        return $this->hasMany('App\MealPlan');
    }

}
