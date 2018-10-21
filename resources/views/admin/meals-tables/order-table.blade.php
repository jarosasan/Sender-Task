@extends('layouts.app')
@include('admin.partials.menu')
@section('content')
    <div class="container">
        @if($orders == 1)
            <div class="row ">
                <div class="col text-center">
                    <h3>All orders are confirmed</h3>
                </div>
            </div>
        @else
        @foreach($orders['menu'] as $order)
        <div class="row ">
            <div class="col text-center">
                <h4>{{$order['day']}}</h4>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Sum</th>
                </tr>
                </thead>
                <tbody>
                @foreach($order['meals'] as $key=>$meal)
                <tr>
                    <th scope="row">{{$key +=1}}</th>
                    <td>{{$meal['title']}}</td>
                    <td>{{$meal['price']}} eur</td>
                    <td>{{$meal['quantity']}} pic</td>
                    <td>{{$meal['productSum']}} eur</td>
                </tr>
                @endforeach
                <tr>
                    <th></th>
                    <td></td>
                    <td></td>
                    <td >Total:</td>
                    <td>{{$order['daySum']}}eur</td>
                </tr>
                </tbody>
            </table>
        </div>
        @endforeach
            <div class="row ">
                <div class="col-sm-12 text-right" >
                    <h5>Total: {{$orders['total']}}eur</h5>
                </div>
            </div>
            <form action="{{route('orders.update')}}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="com-sm-12 text-center">
                        <button name="order" type="submit" value="{{$orders['orderId']}}" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </form>
        @endif
    </div>
@endsection
