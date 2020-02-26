@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">{{ Breadcrumbs::render('page', $model) }}</div>
        </div>
        <div class="row">
            <div class="col">
                <h1 class="h1-title">{{ $model->title }}</h1>
                <hr>

                @foreach($model->images as $image)
                    <img src="{!! $image->resize(400, 200) !!}" class="img-fluid">
                @endforeach

                {!! $model->description !!}
            </div>
        </div>
    </div>
@endsection