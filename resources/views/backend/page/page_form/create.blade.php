@extends('backend.layouts.app')

@section('title', 'Добавить')

@section('breadcrumbs', Breadcrumbs::view('breadcrumbs.backend', 'admin.page.create'))

@section('content')
    <div class="page-body">
        {!! Form::open(['route' => 'admin.page.store', 'files' => true]) !!}
            @include('backend.page.page_form._form', ['submit' => 'Добавить'])
        {!! Form::close() !!}
    </div>
@stop
