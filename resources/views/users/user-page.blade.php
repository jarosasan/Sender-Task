@extends('layouts.app')
@include('users.partials.menu')
@include('users.partials.navs-days')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="col-md-4 text-center" style="border: #1b1e21 1px solid; padding: 20px; height: 350px;">
                    @include('users.forms.create-meals-form')
                </div>
            </div>
        </div>
    </div>
@endsection
