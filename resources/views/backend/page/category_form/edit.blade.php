@extends('backend.layouts.app')

@section('title', 'Редактирование категории')

@section('breadcrumbs', Breadcrumbs::view('breadcrumbs.backend', 'admin.page_category.edit', $category->id))

@section('content')

    <div class="page-body">
        {!! Form::model($category, ['method' => 'put', 'route' => ['admin.page_category.update', $category->id], 'files' => true]) !!}
            @include('backend.page.category_form._form', ['submit' => 'Обновить'])
        {!! Form::close() !!}
    </div>
@endsection
