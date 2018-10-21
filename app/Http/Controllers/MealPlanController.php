<?php

namespace App\Http\Controllers;

use App\Meal;
use App\MealPlan;
use App\Order;
use App\Plan;
use App\Soup;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\MenuService;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\MealPlan as PlanResource;
use App\Http\Resources\MealPlanCollection as PlanResourceCollection;

class MealPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $start = Carbon::parse('next week')->addDays(0)->format('Y-m-d');

        $menu = new MenuService();
        $response = $menu->getMenu($start);
        $request = Request();
        if($request->expectsJson()){
            return new PlanResource( $response = $menu->menu($start));
        }
        return view('admin.meals-tables.meals-plan-table', $data = $response);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nextWeek = [];
        for ($i=0; $i < 5; $i++){
            $day= Carbon::parse('next week')->addDays($i);
            $nextWeek[] = $day->format('l Y-m-d');
        }

        $soups = Meal::where('category_id', 1)->get();
        $mainDish = Meal::where('category_id', 2)->get();
        $salads = Meal::where('category_id', 3)->get();
        $sideDish = Meal::where('category_id', 4)->get();
        $addons = Meal::where('category_id', 5)->get();


        return view('admin.forms.plan_form', $data = ['nextWeak'=>$nextWeek, 'soups' => $soups, 'mainDish'=>$mainDish, 'salads'=>$salads, 'sideDish'=>$sideDish, 'addons'=>$addons]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $size = [];
        if (!empty($request['size-m'])){
            $size[]= $request['size-m'];
        }
        if (!empty($request['size-l'])){
            $size[]= $request['size-l'];
        }
        $size = serialize($size);
         $addon = $request['addon_id'];

        $date = explode(" ", $request['week_day']);
        $meal = Meal::findOrFail($request['meal_id']);

        $category = $meal->category_id;


        $plan = new MealPlan();
        $plan->create($request->except('_token', 'size', 'addon_id', 'weekday', 'date') + ['size'=>$size, 'addon_id'=>$addon, 'weekday'=>$date[0], 'date'=>$date[1], 'category_id'=> $category]);

        if(isset($addon)) {
            $plan = new MealPlan();
            $plan->create($request->except('_token', 'size', 'addon_id', 'weekday', 'date', 'meal_id') + ['meal_id' => $addon,  'weekday' => $date[0], 'date' => $date[1], 'category_id' => 5]);
        }
        return redirect()->back();

    }

    public function confirm(Request $request)
    {
        $order = new Order();
        $order = $order->create(['user_id'=> Auth::user()->id, 'status'=>1]);
        for ($i = 0; $i<5; $i++) {
            $day = Carbon::parse($request['submit'])->addDays($i)->format('Y-m-d');
            $mealPlan = MealPlan::where('date', $day)->get();
            foreach($mealPlan as $meal){
                $meal->update(['order_id' => $order->id]);
            }
        }
        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MealPlan  $mealPlan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $meal = MealPlan::where('meal_id', $id)->first();
        $addonId = $meal->addon_id;
        if( $addonId){

            $meal->update(['addon_id'=>null]);
            MealPlan::where('meal_id', $addonId)->delete();
        }
        $meal->delete();

        return redirect(route('plan.index'));
    }
}
