@extends('layouts.app')
@include('admin.partials.menu')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col text-center mb-5">
                <h2>Meals</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                    @include('admin.meals-tables.meals-table')
            </div>
            <div class="col-md-4 text-center" style="border: #1b1e21 1px solid; padding: 20px; height: 350px;">
                    @include('admin.forms.create-meals-form')
            </div>
        </div>
    </div>
@endsection
