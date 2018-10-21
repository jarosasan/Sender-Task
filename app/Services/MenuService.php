<?php
/**
 * Created by PhpStorm.
 * User: jaroslavlomecki
 * Date: 14/10/2018
 * Time: 17:02
 */

namespace App\Services;


use App\Meal;
use App\MealPlan;
use Carbon\Carbon;

class MenuService
{
    public function getMenu($firstWeekDay)
    {

        $start = Carbon::parse($firstWeekDay)->addDays(0)->format('Y-m-d');
        $end = Carbon::parse($firstWeekDay)->addDays(4)->format('Y-m-d');
        $weekMeals = MealPlan::whereBetween('date', [$start, $end])->get();
        $order =  MealPlan::where('date', $start)->first();


        $response = [];
        $response['feed']['from']=$start;
        $response['feed']['to']=$end;
        $response['order']=$order->order_id;
        for ($i= 0; $i < 5; $i++){
            $day=Carbon::parse('next week')->addDays($i) ;
            $weekDay = $day->format('Y-m-d');
            $response['date'][$i]['date']=$weekDay;
            $response['date'][$i]['day']=$day->format('l');;
            foreach ($weekMeals as $meal){
                if ($meal->category_id == 1 && $meal->date == $weekDay){
                    $soup = $meal->meal;
                    if($meal->size){
                        $soup['size'] = unserialize($meal->size) ;
                    }else{
                        $soup['size'] = '';
                    }
                    $response['date'][$i]['soups'][] = $soup;
                }
                if ($meal->category_id == 2 && $meal->date == $weekDay){
                    $dish = [];
                    $dish['dish'][] = $meal->meal;
                    $dish['sideDishesCount']['hot'] = $meal->hot;
                    $dish['sideDishesCount']['cold'] = $meal->cold;
                    $response['date'][$i]['mainDish'][] = $dish;
                }
                if ($meal->category_id == 3 && $meal->date == $weekDay){
                    $item = $meal->meal;
                    if($meal->addon_id){
                        $addon = Meal::findOrFail($meal->addon_id);
                        $item['addons'] = $addon;
                    }else{
                        $addon = [];
                        $item['addons'] = $addon;
                    }
                    $response['date'][$i]['salad'][] = $item;
                }
                if ($meal->category_id == 4 && $meal->date == $weekDay){
                    $item = $meal->meal;
                    $item['type'] = $meal->type;
                    $response['date'][$i]['sideDish'][] = $item;
                }
            }
        }
        return  $response;
  }

    public function oneDayMenu($day)
    {

        $start = Carbon::parse('next week')->addDays($day);
        $wDay = $start->format('Y-m-d');
        $weekMeals = MealPlan::where('date', $wDay)->get();


        $response = [];
            $weekDay = $start->format('Y-m-d');
            $response['date']=$weekDay;
            $response['day']=$start->format('l');;
            foreach ($weekMeals as $meal){
                if ($meal->category_id == 1 && $meal->date == $weekDay){
                    $soup = $meal->meal;
                    $soup['plan_id'] = $meal->id;
                    if($meal->size){
                        $soup['size'] = unserialize($meal->size) ;
                    }else{
                        $soup['size'] = '';
                    }
                    $response['soups'][] = $soup;
                }
                if ($meal->category_id == 2 && $meal->date == $weekDay){
                    $dish = [];
                    $item = $meal->meal;
                    $item['plan_id'] = $meal->id;
                    $dish['dish'][] = $item;
                    $dish['sideDishesCount'][] = $meal->hot;
                    $dish['sideDishesCount'][] = $meal->cold;
                    $response['mainDish'][] = $dish;
                }
                if ($meal->category_id == 3 && $meal->date == $weekDay){
                    $item = $meal->meal;
                    $item['plan_id'] = $meal->id;

                    if($meal->addon_id){
                        $mPlan = MealPlan::where('meal_id', $meal->addon_id)->first();
                        $addon = Meal::where('id', $meal->addon_id)->first();
                        $addon['plan_id'] =$mPlan->id;
                        $item['addon'] = $addon;
                    }else{
                        $addon = [];
                        $item['addons'] = $addon;
                    }
                    $response['salad'][] = $item;
                }
                if ($meal->category_id == 4 && $meal->date == $weekDay){
                    $item = $meal->meal;
                    $item['plan_id'] = $meal->id;
                    $item['type'] = $meal->type;
                    $response['sideDish'][] = $item;
                }
            }
        return  $response;
    }

    public function menu($day)
    {
        $start = Carbon::parse($day)->addDays(0)->format('Y-m-d');
        $end = Carbon::parse($day)->addDays(4)->format('Y-m-d');

        $response = [];
        $response['feed']['date']['from']=$start;
        $response['feed']['date']['to']=$end;
        for ($k=0; $k<5; $k++){

            $start = Carbon::parse($day)->addDays($k);
            $weekDay = $start->format('Y-m-d');
            $dayW = $start->format('l');
            $dayResponse['date']=$weekDay;
            $weekMeals =  MealPlan::where('date', $weekDay)->get();
            $response['feed']['days'][$dayW]['date']=$weekDay;


            foreach ($weekMeals as $meal){
                if ($meal->category_id == 1 && $meal->date == $weekDay){
                    if($meal->size){
                        $s = unserialize($meal->size);
                        $size = implode(",", $s);
                    }else{
                        $size = "";
                    }
                    $soup = [];
                    $soup['title'] = $meal->meal->title." (".$size.")";
                    $soup['price'] = $meal->meal->price;
                    $response['feed']['days'][$dayW]['meals']['soups'][] = $soup;
                }
                if ($meal->category_id == 2 && $meal->date == $weekDay){
                    $dish = [];
                    $dish['title'] = $meal->meal->title;
                    $dish['price'] = $meal->meal->price;
                    $dish['sideDishesCount'][]['hot'] = $meal->hot;
                    $dish['sideDishesCount'][]['cold'] = $meal->cold;
                    $response['feed']['days'][$dayW]['meals']['mainDish'][] = $dish;
                }
                if ($meal->category_id == 3 && $meal->date == $weekDay){
                    $item = [];
                    $item['title'] = $meal->meal->title;
                    $item['price'] = $meal->meal->price;
                    if($meal->addon_id) {
                        $addons = Meal::where('id', $meal->addon_id)->get();
                        $i = [];
                        foreach ($addons as $addon) {
                            $i['title'] = $addon->title;
                            $i['price'] = $addon->price;
                            $item['addons'][] = $i;
                        }
                    }else{
                        $addon = [];
                        $item['addons'] = $addon;
                    }
                    $response['feed']['days'][$dayW]['meals']['salad'][] = $item;
                }
                if ($meal->category_id == 4 && $meal->date == $weekDay){
                    $response['feed']['days'][$dayW]['meals']['sideDishes']['dishTypes'][] = $meal->type;
                    $d = [];
                    $d['title'] = $meal->meal->title;
                    $d['price'] = $meal->meal->price;
                    $response['feed']['days'][$dayW]['meals']['sideDishes']['dish'][]= $d;
                }
            }
        }
        return  $response;
    }

}
