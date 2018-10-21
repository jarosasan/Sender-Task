@extends('layouts.app')
@include('admin.partials.menu')
@section('content')
    <div class="container">
        <div class="row">
            <table class="table table-striped">
            <thead>
                <tr>
                    <th >Id</th>
                    <th >Sum</th>
                </tr>
            </thead>
            <tbody>
                @if(empty($orders))
                @else
                    @foreach($orders as $order)
                        @if(!empty($order))
                            <tr>
                                <th>{{$order->id}}</th>
                                <th>{{$order->price_total}}</th>
                            </tr>
                        @endif
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
