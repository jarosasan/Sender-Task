<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MealCategory extends Model
{

    protected $fillable = [
        'title',
    ];

    public function meals(){
        return $this->hasMany('App\Meal');
    }

}
