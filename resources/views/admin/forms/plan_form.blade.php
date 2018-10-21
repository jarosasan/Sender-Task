@extends('layouts.app')
@include('admin.partials.menu')
@section('content')
<div class="container">
    <div class="row">
        <h3 class="col text-center">Create new Meniu</h3>
    </div>
    <div class="row text-center">
        <div class="col-sm-5 text-center" style="margin: 20px auto; padding: 20px; border: 1px solid black">
            <form method="POST" action="{{ route('plan.store') }}">
                @csrf
                <h3 class="col text-center m-lg-2">Soups</h3>
                <div class="form-group row" style=" height: 100px">
                    <div class="col-sm-12">
                        <div class="row m-1">
                            <label for="exampleFormControlSelect1" class="col-sm-2 col-form-label">Select date</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="exampleFormControlSelect1" name="week_day">
                                    @foreach($nextWeak as $day)
                                        <option value="{{$day}}">{{$day}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('week_day'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('week_day') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row" style=" height: 150px">
                    <div class="col-sm-12">
                        <div class="row m-1">
                            <label for="dish" class="col-sm-2 col-form-label">Soup</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="dish" name="meal_id">
                                    <option></option>
                                    @foreach($soups as $soup)
                                        <option value="{{$soup->id}}">{{$soup->title}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('meal_id'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('meal_id') }}</strong>
                                </span>
                                @endif
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="size-m" value="M" name="size-m">
                                    <label class="form-check-label" for="size-m">M</label>
                                    @if ($errors->has('size-m'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('size-m') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="size-l" value="L" name="size-l">
                                    <label class="form-check-label" for="size-l">L</label>
                                    @if ($errors->has('size-l'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('size-l') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row" style=" height: 50px">
                    <div class="col-sm-12 text-center " >
                        <button type="submit" class="btn btn-success btn-lg btn-block">Create</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-sm-5 text-center" style="margin: 20px auto; padding: 20px; border: 1px solid black">
            <form method="POST" action="{{ route('plan.store') }}">
                @csrf
                <h3 class="col text-center m-lg-2">Main Dishes</h3>
                <div class="form-group row" style="height: 100px">
                    <div class="col-sm-12">
                        <div class="row m-1">
                            <label for="exampleFormControlSelect1" class="col-sm-2 col-form-label">Select date</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="exampleFormControlSelect1" name="week_day">
                                    @foreach($nextWeak as $day)
                                        <option value="{{$day}}">{{$day}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('week_day'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('week_day') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row" style="height: 150px">
                    <div class="col-sm-12">
                        <div class="row m-1">
                        <label for="dish" class="col-sm-2 col-form-label">MainDish</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="dish" name="meal_id">
                                <option></option>
                                @foreach($mainDish as $dish)
                                    <option value="{{$dish->id}}">{{$dish->title}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('meal_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('meal_id') }}</strong>
                                </span>
                            @endif
                            <h5 class=" text-left m-2">Side Dishes count</h5>
                            <div class="row">
                                <div class="col-sm-6 text-left">
                                    <div class="form-check form-check-inline">
                                        <label for="dish-1-hot" class="col-form-label col-sm-6">Hot </label>
                                        <select class="form-control col-sm-6" id="dish-1-hot" name="hot">
                                            <option value=0>0</option>
                                            <option value=1>1</option>
                                        </select>
                                        @if ($errors->has('hot'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('hot') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6 text-left">
                                    <div class="form-check form-check-inline">
                                        <label for="dish-1-cold" class="col-form-label col-sm-6">Cold </label>
                                        <select class="form-control col-sm-6" id="dish-1-cold" name="cold">
                                            <option value=0>0</option>
                                            <option value=1>1</option>
                                        </select>
                                        @if ($errors->has('cold'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('cold') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <div class="form-group row" style="height: 50px">
                    <div class="col-sm-12 text-center" style="margin-bottom: 20px; position: absolute;">
                        <button type="submit" class="btn btn-success btn-lg btn-block">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row text-center">
        <div class="col-sm-5 text-center" style="margin: 20px auto; padding: 20px; border: 1px solid black">
            <form method="POST" action="{{ route('plan.store') }}">
                @csrf
                <h3 class="col text-center m-lg-2">Salads</h3>
                <div class="form-group row" style=" height: 100px">
                    <div class="col-sm-12">
                        <div class="row m-1">
                            <label for="exampleFormControlSelect1" class="col-sm-2 col-form-label">Select date</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="exampleFormControlSelect1" name="week_day">
                                    @foreach($nextWeak as $day)
                                        <option value="{{$day}}">{{$day}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('week_day'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('week_day') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row" style=" height: 150px">
                    <div class="col-sm-12">
                        <div class="form-row m-1">
                            <label for="salad" class="col-sm-2 col-form-label">Salad</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="salad" name="meal_id">
                                    <option></option>
                                    @foreach($salads as $salad)
                                        <option value="{{$salad->id}}">{{$salad->title}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('meal_id'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('meal_id') }}</strong>
                                </span>
                                @endif
                                <h5 class=" text-left m-2">Salad additives</h5>
                                <div class="form-row">
                                    <div class="form-check-inline" style="width: 100%;">
                                        <label for="addon" class="col-check-label col-md-4">Additive: </label>
                                        <select class="form-control col-md-5" id="addon" name="addon_id">
                                            <option></option>
                                            @foreach($addons as $addon)
                                                <option value="{{$addon->id}}">{{$addon->title}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('addon_id"'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('addon_id"') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row" style=" height: 50px">
                    <div class="col-sm-12 text-center " >
                        <button type="submit" class="btn btn-success btn-lg btn-block">Create</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-sm-5 text-center" style="margin: 20px auto; padding: 20px; border: 1px solid black">
            <form method="POST" action="{{ route('plan.store') }}">
                @csrf
                <h3 class="col text-center m-lg-2">Side Dishes</h3>
                <div class="form-group row" style="height: 100px">
                    <div class="col-sm-12">
                        <div class="row m-1">
                            <label for="exampleFormControlSelect1" class="col-sm-2 col-form-label">Select date</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="exampleFormControlSelect1" name="week_day">
                                    @foreach($nextWeak as $day)
                                        <option value="{{$day}}">{{$day}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('week_day'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('week_day') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row" style="height: 150px">
                    <div class="col-sm-12">
                        <div class="row m-1">
                            <label for="dish" class="col-sm-2 col-form-label">Dish</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="dish" name="meal_id">
                                    <option></option>
                                    @foreach($sideDish as $dish)
                                        <option value="{{$dish->id}}">{{$dish->title}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('meal_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('meal_id') }}</strong>
                                    </span>
                                @endif
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="dish-1-h" value="hot" name="type" required>
                                    <label class="form-check-label" for="dish-1-h">Hot</label>
                                    @if ($errors->has('type'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('type') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="dish-1-c" value="cold" name="type" required>
                                    <label class="form-check-label" for="dish-1-c">Cold</label>
                                    @if ($errors->has('type'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('type') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row" style="height: 50px">
                    <div class="col-sm-12 text-center" style="margin-bottom: 20px; position: absolute;">
                        <button type="submit" class="btn btn-success btn-lg btn-block">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
