@extends('backend.layouts.app')

@section('title', 'Создание категории')

@section('breadcrumbs', Breadcrumbs::view('breadcrumbs.backend', 'admin.page_category.create'))

@section('content')

    <div class="page-body">
        {!! Form::open(['route' => 'admin.page_category.store', 'files' => true]) !!}
            @include('backend.page.category_form._form', ['submit' => 'Добавить'])
        {!! Form::close() !!}
    </div>
@endsection
