@extends('layouts.app')
@include('admin.partials.menu')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 text-center m-3">
                <h3>MENU {{$feed['from']}}   /  {{$feed['to']}}</h3>
            </div>
            @for($i = 0; $i < 5; $i++)
            <div class="col" style="margin: 2px; border: 1px solid black; width: 100%;">
                <h6>{{$date[$i]['day']}} {{$date[$i]['date']}}</h6>
                <h5>Soups</h5>
                <ul class="list-group">
                    @if(isset($date[$i]['soups']))
                        @foreach($date[$i]['soups'] as $soup)
                            <li class="d-flex ">
                                {{$soup['title']}} ({{(isset($soup['size'][0]))?$soup['size'][0]:'' }}{{(isset($soup['size'][1])) ? ', '.$soup['size'][1] : ''}})
                                <form action="{{route('plan.destroy', $soup['id'])}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="border:none; background-color:transparent; cursor: pointer;"><i class="fa fa-remove" style="font-size:20px;color:red"></i></button>
                                </form>
                            </li>
                        @endforeach
                    @endif
                </ul>
                <hr>
                <h5>Main Dishes</h5>
                <ul class="list-group">
                    @if(isset($date[$i]['mainDish']))
                        @foreach($date[$i]['mainDish'] as $mainDish)
                            <li class="d-flex ">
                                {{$mainDish['dish'][0]['title']}}
                                <form action="{{route('plan.destroy', $mainDish['dish'][0]['id'])}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="border:none; background-color:transparent; cursor: pointer;"><i class="fa fa-remove" style="font-size:20px;color:red"></i></button>
                                </form>
                                <br>
                                <li class="list-group">Side dishes: </li>
                                    <li class="d-flex "> Hot: {{$mainDish['sideDishesCount']['hot']}}</li>
                                    <li class="d-flex "> Cold: {{$mainDish['sideDishesCount']['cold']}}</li>
                            <br>
                        @endforeach
                    @endif
                </ul>
                <hr>
                <h5>Salads</h5>
                <ul class="list-group">
                    @if(isset($date[$i]['salad']))
                        @foreach($date[$i]['salad'] as $salad)
                            <li class="d-flex ">{{$salad['title']}}
                                <form action="{{route('plan.destroy', $salad['id'])}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="border:none; background-color:transparent; cursor: pointer;"><i class="fa fa-remove" style="font-size:20px;color:red"></i></button>
                                </form>
                            </li>
                            <li class="d-flex ">
                                <ul class="list-group">Add on
                                    @if(isset($salad['addons']['id']))
                                        <li class="d-flex ">{{(isset($salad['addons']['title'])) ? $salad['addons']['title']: '-'}}

                                        </li>
                                    @else
                                        <li class="d-flex ">-</li>
                                    @endif
                                </ul>
                            </li>
                        @endforeach
                    @endif
                </ul>
                <hr>
                <h5>Side Dishes</h5>
                <ul class="list-group">
                    @if(isset($date[$i]['sideDish']))
                        @foreach($date[$i]['sideDish'] as $sideDish)
                            <li class="d-flex">{{$sideDish['title']}} ({{$sideDish['type']}})
                                <form action="{{route('plan.destroy', $sideDish['id'])}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="border:none; background-color:transparent; cursor: pointer;"><i class="fa fa-remove" style="font-size:20px;color:red"></i></button>
                                </form>
                            </li>
                        @endforeach
                    @endif
                </ul>
                <hr>
            </div>
            @endfor
        </div>
        <div class="row">
            <div class="col-sm-6 text-center"><a role="button" class="btn btn-success" href="{{route('plan.create')}}"> Update Menu</a></div>

            @if(empty($order))
            <form action="{{route('plan.confirm')}}" method="POST">
                @csrf
                <div class="col-sm-6 text-center"><button name="submit" type="submit" value="{{$date[0]['date']}}" class="btn btn-success"> Confirmed Menu</button></div>
            </form>
            @endif
        </div>
    </div>
@endsection
