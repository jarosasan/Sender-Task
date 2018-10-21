<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MealPlan extends Model
{
   protected $fillable = [
       'meal_id', 'size', 'hot', 'cold', 'addon_id', 'type', 'weekday', 'date', 'category_id', 'quantity', 'order_id',
       ];

    public function meal(){
        return $this->belongsTo('App\Meal', 'meal_id');
   }
    public function category(){
        return $this->hasOne('App\MealCategory');
    }

    public function order()
    {
        return $this->belongsTo('App\Order');
    }

}
