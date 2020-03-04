@extends('backend.layouts.app')

@section('title', 'Добавить')

@section('breadcrumbs', Breadcrumbs::view('breadcrumbs.backend', 'admin.user.create'))

@section('content')
    <div class="page-body">
        {!! Form::open(['route' => 'admin.user.store', 'files' => true]) !!}
        @include('backend.user._form', ['submit' => 'Добавить'])
        {!! Form::close() !!}
    </div>
@stop
