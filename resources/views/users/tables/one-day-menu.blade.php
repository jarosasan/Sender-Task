@extends('layouts.app')
@include('users.partials.menu')
@include('users.partials.navs-days')
@section('content')
    <div class="container">
        <div class="row ">
            <div class="card" style="width: 20rem; margin: 20px auto;">
                <div class="card-header">
                    {{$date}}
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Soup:</strong>  @if(isset($meals['soup'])){{$meals['soup']->title}} {{$meals['soup']->price}}&#x20AC @endif</li>
                    <li class="list-group-item">Main Dish: @if(isset($meals['mainDish'])){{$meals['mainDish']->title}}  {{$meals['mainDish']->price}}&#x20AC @endif</li>
                    <li class="list-group-item">Salad: @if(isset($meals['salad'])){{$meals['salad']->title}}  {{$meals['salad']->price}}&#x20AC @endif</li>
                    <li class="list-group-item">Salad add on: @if(isset($meals['addon'])){{$meals['addon']->title}}  {{$meals['addon']->price}}&#x20AC @endif</li>
                    <li class="list-group-item">Side Dish Hot: @if(isset($meals['sideDishHot'])){{$meals['sideDishHot']->title}} @endif</li>
                    <li class="list-group-item">Side Dish Cold: @if(isset($meals['sideDishCold'])){{$meals['sideDishCold']->title}} @endif</li>
                    <li class="list-group-item">Sum: @if(isset($sum)){{$sum}} &#x20AC @endif</li>
                </ul>
            </div>
        </div>
    </div>
@endsection
