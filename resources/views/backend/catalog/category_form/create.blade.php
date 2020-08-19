@extends('backend.layouts.app')

@section('title', 'Создание категории')

@section('breadcrumbs', Breadcrumbs::view('breadcrumbs.backend', 'admin.category.create'))

@section('content')

    <div class="page-body">
        {!! Form::open(['route' => 'admin.category.store', 'files' => true]) !!}
            @include('backend.catalog.category_form._form', ['submit' => 'Добавить'])
        {!! Form::close() !!}
    </div>
@endsection
