@extends('layouts.app')
@include('users.partials.menu')
@include('users.partials.navs-days')
@section('content')
<div class="container">
    <div class="row">
        <h3 class="col text-center">Create new Meniu for {{$menu['day']}} - {{$menu['date']}}</h3>
    </div>
    <div class="row text-center">
        <div class="col-sm-5 text-center" style="margin: 20px auto; padding: 10px; border: 1px solid black">
            <form method="POST" action="{{ route('menu.store') }}">
                @csrf

                <h3 class="col text-center m-lg-2">Soups</h3>
                <div class="form-group row" style=" min-height: 80px">
                    <div class="col-sm-12">
                        <div class="row m-1">
                            <div class="col-sm-10">
                                @if(!empty($menu['soups']))
                                    @foreach($menu['soups'] as $soup)
                                        <div class="form-check">
                                            <input name="soup" class="form-check-input" type="radio" value="{{$soup->plan_id}}" id="defaultCheck1">
                                            <label class="form-check-label" for="defaultCheck1">
                                                {{$soup->title}} Price: {{$soup->price}} Eur.
                                            </label>
                                        </div>
                                     @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <h3 class="col text-center m-lg-2">Main Dishes</h3>
                <div class="form-group row" style=" min-height: 80px">
                    <div class="col-sm-12">
                        <div class="row m-1">
                            <div class="col-sm-10">
                                @if(!empty($menu['mainDish']))
                                    @foreach($menu['mainDish'][0]['dish'] as $dish)
                                        <div class="form-check">
                                            <input name="mainDish" class="form-check-input" type="radio" value="{{$dish->plan_id}}" id="defaultCheck1">
                                            <label class="form-check-label" for="defaultCheck1">
                                                {{$dish->title}} Price: {{$dish->price}} Eur.
                                            </label>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <h3 class="col text-center m-lg-2">Salad</h3>
                <div class="form-group row" style=" min-height: 80px">
                    <div class="col-sm-12">
                        <div class="row m-1">
                            <div class="col-sm-10">
                                @if(!empty($menu['salad']))
                                    @foreach($menu['salad'] as $salad)
                                        <div class="form-check">
                                                <input name="salad" class="form-check-input" type="radio" value="{{$salad->plan_id}}" id="defaultCheck1">
                                                <label class="form-check-label" for="defaultCheck1">
                                                    {{$salad->title}} Price: {{$salad->price}} Eur.
                                                </label>
                                            @if(!empty($salad->addon))
                                             <h5>Add on</h5>
                                                    <input name="addon" class="form-check-input" type="checkbox" value="{{$salad->addon->plan_id}}" id="defaultCheck1">
                                                    <label class="form-check-label" for="defaultCheck1">
                                                        {{$salad->addon->title}} Price: {{$salad->addon->price}} Eur.
                                                    </label>
                                            @endif
                                        </div>
                                        <br>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                    <h3 class="col text-center m-lg-2">Side Dishes</h3>
                    <div class="form-group row" style=" min-height: 100px">
                        <div class="col-sm-12">
                            <div class="row m-1">
                                <div class="col-12">
                                    <div class="row">
                                        <h6 class="col-12 text-center m-lg-2">Hot Side Dishes</h6>
                                        @if(!empty($menu['sideDish']))
                                            @foreach($menu['sideDish'] as $dish)
                                                @if($dish->type == 'hot')
                                                    <div class="col-12 form-check">
                                                        <input name="sideDishHot" class="form-check-input" type="radio" value="{{$dish->plan_id}}" id="defaultCheck1">
                                                        <label class="form-check-label" for="defaultCheck1">
                                                            {{$dish->title}} ({{$dish->type}})
                                                        </label>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                    <br>
                                    <div class="row">
                                        <h6 class="col-12 text-center m-lg-2">Cold Side Dishes</h6>
                                        @if(!empty($menu['sideDish']))
                                            @foreach($menu['sideDish'] as $dish)
                                                @if($dish->type == 'cold')
                                                    <div class="col-12 form-check">
                                                        <input name="sideDishCold" class="form-check-input" type="radio" value="{{$dish->plan_id}}" id="defaultCheck1">
                                                        <label class="form-check-label" for="defaultCheck1">
                                                            {{$dish->title}} ({{$dish->type}}).
                                                        </label>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                    <input  type="hidden" name="date" value="{{$menu['date']}}">
                    </div>
                </div>
                <div class="form-group row" style=" min-height: 50px">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

