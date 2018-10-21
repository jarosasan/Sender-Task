<?php

namespace App\Http\Controllers;

use App\MealPlan;
use App\Order;
use App\Services\MenuService;
use App\UserMenu;
use App\UserOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect(route('menu.create', $day = 0));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($day)
    {
        if($day == 5){
            $day = 4;
        }
        $user = Auth::user();
        $weekDay = Carbon::parse('next week')->addDays($day)->format('Y-m-d');
        $order = UserOrder::where([['date','=', $weekDay], ['user_id', '=', $user->id]])->first();

        if($order) {
            $date = Carbon::parse('next week')->addDays($day)->format('l Y-m-d');
            $userMenu = UserMenu::where('order_id', $order->id)->get();
            $result = [];
            $sum = 0;
            foreach ($userMenu as $menu) {
                if ($menu->mealPlan->meal->category_id == 1) {
                    $result['soup'] = $menu->mealPlan->meal;
                    $sum = $sum + $menu->mealPlan->meal->price;
                }
                if ($menu->mealPlan->meal->category_id == 2) {
                    $result['mainDish'] = $menu->mealPlan->meal;
                    $sum = $sum + $menu->mealPlan->meal->price;
                }
                if ($menu->mealPlan->meal->category_id == 3) {
                    $result['salad'] = $menu->mealPlan->meal;
                    $sum = $sum + $menu->mealPlan->meal->price;
                }
                if ($menu->mealPlan->meal->category_id == 4) {
                    if($menu->mealPlan['type'] == 'hot'){
                        $result['sideDishHot'] = $menu->mealPlan->meal;
                    }
                    if($menu->mealPlan['type'] == 'cold'){
                        $result['sideDishCold'] = $menu->mealPlan->meal;
                    }
                }
                if ($menu->mealPlan->meal->category_id == 5) {
                    $result['addon'] = $menu->mealPlan->meal;
                    $sum = $sum + $menu->mealPlan->meal->price;
                }
            }
            return view('users.tables.one-day-menu', $data=['meals'=>$result, 'sum'=>$sum, 'date'=>$date]);
        }


        $menu = new MenuService();
        $oneDayMenu = $menu->oneDayMenu($day);

        return view('users.forms.user-menu-form', $data = ['menu'=>$oneDayMenu]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $orderUser = new UserOrder();
        $order = $orderUser->create(['user_id'=>$user->id, 'date'=>$request['date']]);


        if (isset($request['soup'])){

            $userMenu = new UserMenu();
            $userMenu->create(['meal_plan_id'=>$request['soup'], 'order_id'=>$order->id, 'user_id'=>$user->id, 'date'=>$request['date']]);
            $sum = $order->sum_total;
            $mealPlanItem = MealPlan::findOrFail($request['soup']);
            $quantity = $mealPlanItem->quantity += 1;
            $mealPlanItem->update(['quantity'=>$quantity]);
            $price = $mealPlanItem->meal->price;
            $order->update(['sum_total'=>$sum+$price]);
        }
        if (isset($request['mainDish'])){

            $userMenu = new UserMenu();
            $userMenu->create(['meal_plan_id'=>$request['mainDish'], 'order_id'=>$order->id, 'user_id'=>$user->id, 'date'=>$request['date']]);
            $sum = $order->sum_total;
            $mealPlanItem = MealPlan::findOrFail($request['mainDish']);
            $quantity = $mealPlanItem->quantity += 1;
            $mealPlanItem->update(['quantity'=>$quantity]);
            $price = $mealPlanItem->meal->price;
            $order->update(['sum_total'=>$sum+$price]);
        }
        if (isset($request['salad'])){

            $userMenu = new UserMenu();
            $userMenu->create(['meal_plan_id'=>$request['salad'], 'order_id'=>$order->id, 'user_id'=>$user->id, 'date'=>$request['date']]);
            $sum = $order->sum_total;
            $mealPlanItem = MealPlan::findOrFail($request['salad']);
            $quantity = $mealPlanItem->quantity += 1;
            $mealPlanItem->update(['quantity'=>$quantity]);
            $price = $mealPlanItem->meal->price;
            $order->update(['sum_total'=>$sum+$price]);
        }
        if (isset($request['addon'])){
            $userMenu = new UserMenu();
            $userMenu->create(['meal_plan_id'=>$request['addon'], 'order_id'=>$order->id, 'user_id'=>$user->id, 'date'=>$request['date']]);
            $sum = $order->sum_total;
            $mealPlanItem = MealPlan::findOrFail($request['addon']);
            $quantity = $mealPlanItem->quantity += 1;
            $mealPlanItem->update(['quantity'=>$quantity]);
            $price = $mealPlanItem->meal->price;
            $order->update(['sum_total'=>$sum+$price]);
        }
        if (isset($request['sideDishHot'])){
            $userMenu = new UserMenu();
            $userMenu->create(['meal_plan_id'=>$request['sideDishHot'], 'order_id'=>$order->id, 'user_id'=>$user->id, 'date'=>$request['date']]);
            $mealPlanItem = MealPlan::findOrFail($request['sideDishHot']);
            $quantity = $mealPlanItem->quantity += 1;
            $mealPlanItem->update(['quantity'=>$quantity]);

        }
        if (isset($request['sideDishCold'])){
            $userMenu = new UserMenu();
            $userMenu->create(['meal_plan_id'=>$request['sideDishCold'], 'order_id'=>$order->id, 'user_id'=>$user->id, 'date'=>$request['date']]);
            $mealPlanItem = MealPlan::findOrFail($request['sideDishCold']);
            $quantity = $mealPlanItem->quantity += 1;
            $mealPlanItem->update(['quantity'=>$quantity]);
        }

        $wDay= Carbon::parse($request['date'])->dayOfWeekIso;


        return redirect(route('menu.create', $day = $wDay));
    }



}
