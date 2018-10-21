<?php

namespace App\Http\Controllers;

use App\MealPlan;
use App\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $or = Order::where('confirmed', 0)->get();

        if(!empty($or)){
            return view('admin.meals-tables.order-table', $data=['orders'=>1]);
        }
        $orders  = [];
        $orders['total'] = 0;
        $orders['orderId'] = 0;
        for($i = 0; $i < 5; $i++ ){
            $order  = [];
            $weekDay = Carbon::today()->nextWeekday()->addDay($i)->format('Y-m-d');
            $dayShow = Carbon::today()->nextWeekday()->addDay($i)->format('l Y-m-d');
            $dayOrder = MealPlan::where('date', $weekDay)->orderBy('quantity', 'desc')->get();
            $totalDaySum = 0;
            foreach($dayOrder as $value){
                $orderId = $value->orderId;
                if($value->quantity > 0) {
                    $item = [];
                    $item['title'] = $value->meal->title;
                    $item['price'] = $value->meal->price;
                    $item['quantity'] = $value->quantity;
                    $item['productSum'] = $value->quantity * $value->meal->price;
                    $totalDaySum += $item['productSum'];
                    $order['day'] = $dayShow;
                    $order['daySum']=$totalDaySum;
                    $order['meals'][] = $item;
                }
            }

            $orders['orderId']=$dayOrder[0]->order_id;
            $orders['menu'][$i]=$order;
            $orders['total'] += $totalDaySum;
        }

        $getOrder = Order::findOrFail($dayOrder[0]->order_id);
        $getOrder->update(['price_total'=>$orders['total']]);



     return view('admin.meals-tables.order-table', $data=['orders'=>$orders]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $orders = $order->where('confirmed', 1)->get();

        return view('admin.meals-tables.orders-table', $data = ['orders'=>$orders]);
    }


    public function showOneOrder($id)
    {
        $dayOrder = MealPlan::where('order_id', $id)->orderBy('date', 'asc')->get();
        dd($dayOrder);
        $orders  = [];
        $orders['total'] = 0;
        $orders['orderId'] = 0;
        for($i = 0; $i < 5; $i++ ){
            $order  = [];
            $weekDay = Carbon::today()->nextWeekday()->addDay($i)->format('Y-m-d');
            $dayShow = Carbon::today()->nextWeekday()->addDay($i)->format('l Y-m-d');
            $dayOrder = MealPlan::where('date', $weekDay)->orderBy('quantity', 'desc')->get();
            $totalDaySum = 0;
            foreach($dayOrder as $value){
                $orderId = $value->orderId;
                if($value->quantity > 0) {
                    $item = [];
                    $item['title'] = $value->meal->title;
                    $item['price'] = $value->meal->price;
                    $item['quantity'] = $value->quantity;
                    $item['productSum'] = $value->quantity * $value->meal->price;
                    $totalDaySum += $item['productSum'];
                    $order['day'] = $dayShow;
                    $order['daySum']=$totalDaySum;
                    $order['meals'][] = $item;
                }
            }

            $orders['orderId']=$id;
            $orders['menu'][$i]=$order;
            $orders['total'] += $totalDaySum;
        }

        $getOrder = Order::findOrFail($dayOrder[0]->order_id);
        $getOrder->update(['price_total'=>$orders['total']]);

        return view('admin.meals-tables.order-table', $data=['orders'=>$orders]);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $order = $order->findOrFail($request['order']);
        $order->update(['confirmed'=>1]);
        return redirect(route('orders.show'));
    }


}
