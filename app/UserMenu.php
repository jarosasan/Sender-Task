<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMenu extends Model
{
    protected $fillable = [
        'user_id', 'meal_plan_id', 'order_id', 'date',
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function mealPlan(){
        return $this->belongsTo('App\MealPlan');
    }

    public function order(){
        return $this->belongsTo('App\UserOrder');
    }

}
