@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">{{ Breadcrumbs::render('cabinet') }}</div>
        </div>
        <div class="row">
            <div class="col">
                <h1 class="h1-title">Личный кабинет</h1>
                <hr>
                <example-component></example-component>
            </div>
        </div>
    </div>
@endsection