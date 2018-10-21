<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMealRequest;
use App\Meal ;
use App\MealCategory;
use Illuminate\Http\Request;

class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.meals', $data = ['meals' => Meal::all(), 'categoryes' => MealCategory::all()]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMealRequest $request)
    {
        $meal = new Meal();
        $meal->create($request->except('_token'));
        return redirect(route('meals.index'));
    }




}
