@extends('backend.layouts.app')

@section('title', 'Создание товара')

@section('breadcrumbs', Breadcrumbs::view('breadcrumbs.backend', 'admin.product.create'))

@section('content')

    <div class="page-body">
        {!! Form::open(['route' => 'admin.product.store', 'files' => true]) !!}
            @include('backend.catalog.product_form._form', ['submit' => 'Добавить'])
        {!! Form::close() !!}
    </div>
@endsection
