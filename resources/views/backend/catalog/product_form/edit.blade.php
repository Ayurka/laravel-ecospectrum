@extends('backend.layouts.app')

@section('title', 'Редактирование товара')

@section('breadcrumbs', Breadcrumbs::view('breadcrumbs.backend', 'admin.product.edit', $product->id))

@section('content')

    <div class="page-body">
        {!! Form::model($product, ['method' => 'put', 'route' => ['admin.product.update', $product->id], 'files' => true]) !!}
            @include('backend.catalog.product_form._form', ['submit' => 'Обновить'])
        {!! Form::close() !!}
    </div>
@endsection
