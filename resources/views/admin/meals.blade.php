@extends('layouts.app')
@include('layouts.menu')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col text-center mb-5">
                <h2>Meals</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th >Id</th>
                        <th >Name</th>
                        <th >Size</th>
                        <th >Type</th>
                        <th >Price</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($meals as $meal)
                    <tr>
                        <th>{{$meal->id}}</th>
                        <th>{{$meal->name}}</th>
                        <th>{{$meal->size}}</th>
                        <th>{{$meal->veg}}</th>
                        <th>{{$meal->price}}</th>

                        <th>
                            <form action="{{route('meals.destroy', $meal->id)}}" method="post">
                                {!! csrf_field() !!}
                                {!! method_field('DELETE') !!}
                                <button type="submit" class="btn btn-outline-danger">Delete</button>
                            </form>
                        </th>

                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-4 text-center" style="border: #1b1e21 1px solid; padding: 10px;">
                <h3 class="col mb-md-4">Create new Meal</h3>
                <form method="POST" action="{{ route('meals.store') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="inputNmame" class="col-sm-2 col-form-label">Meal</label>
                        <div class="col-sm-10">
                            <input id="inputNmame" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPrice" class="col-sm-2 col-form-label">Price</label>
                        <div class="col-sm-10">
                            <input id="inputPrice" type="number" step="any" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" name="price" value="{{ old('price') }}" required autofocus>

                            @if ($errors->has('price'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <fieldset class="form-group">
                        <div class="row">
                            <legend class="col-form-label col-sm-2 pt-0">Size</legend>
                            <div class="col-sm-10 text-left">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="size" id="gridRadios1" value="M" >
                                        <label class="form-check-label" for="gridRadios1">
                                            M
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="size" id="gridRadios2" value="L">
                                        <label class="form-check-label" for="gridRadios2">
                                            L
                                        </label>
                                    </div>
                            </div>
                            @if ($errors->has('size'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('size') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </fieldset>
                    <div class="form-group row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10 text-left">
                            <div class="form-check">
                                <input name="veg" value="veg" class="form-check-input" type="checkbox" id="gridCheck1">
                                <label class="form-check-label" for="gridCheck1">
                                    Vegetarian
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
