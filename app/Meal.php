<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'price', 'category_id',
    ];

    public function category(){
        return $this->belongsTo('App\MealCategory');
    }

    public function plan(){
        return $this->belongsTo('App\MealPlan');
    }
}
