@extends('backend.layouts.app')

@section('title', 'Редактирование')

@section('breadcrumbs', Breadcrumbs::view('breadcrumbs.backend', 'admin.order.edit', $order->id))

@section('content')

    <div class="page-body">
        {!! Form::model($order, ['method' => 'put', 'route' => ['admin.order.update', $order->id], 'files' => true]) !!}
        @include('backend.order._form', ['submit' => 'Обновить'])
        {!! Form::close() !!}
    </div>
@endsection
