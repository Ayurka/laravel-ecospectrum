@extends('backend.layouts.app')

@section('title', 'Редактирование')

@section('breadcrumbs', Breadcrumbs::view('breadcrumbs.backend', 'admin.page.edit', $page->id))

@section('content')

    <div class="page-body">
        {!! Form::model($page, ['method' => 'put', 'route' => ['admin.page.update', $page->id], 'files' => true]) !!}
            @include('backend.page.page_form._form', ['submit' => 'Обновить'])
        {!! Form::close() !!}
    </div>
@endsection
