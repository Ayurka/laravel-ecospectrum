@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">{{ Breadcrumbs::render('product', $model) }}</div>
        </div>
        <div class="row">
            <div class="col">
                <div class="row align-items-center">
                    <div class="col">
                        <h1 class="h1-title">{{ $model->title }}</h1>
                    </div>
                    <div class="col-auto">
                        <div class="cart-head">
                            <i class="fas fa-cart-plus fa-2x"></i>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-6 text-center">
                        <img src="{!! $model->image->resize(350, 450) !!}" class="img-fluid">
                    </div>
                    <div class="col-6">
                        {!! $model->description !!}
                        <div class="row">
                            @foreach($model->getPivotAttributes as $attribute)
                                <div class="col-6" style="padding: 25px;">{{ $attribute->title }}<br>{{ $attribute->pivot->text }}</div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection