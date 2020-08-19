@extends('backend.layouts.app')

@section('title', 'Редактирование категории')

@section('breadcrumbs', Breadcrumbs::view('breadcrumbs.backend', 'admin.category.edit', $category->id))

@section('content')

    <div class="page-body">
        {!! Form::model($category, ['method' => 'put', 'route' => ['admin.category.update', $category->id], 'files' => true]) !!}
            @include('backend.catalog.category_form._form', ['submit' => 'Обновить'])
        {!! Form::close() !!}
    </div>
@endsection
