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

@push('after-styles')
    {{--Select 2 css--}}
    <link rel="stylesheet" href="{{ asset('packages/adminty/bower_components/select2/css/select2.min.css') }}">
    {{--Multi Select css--}}
    <link rel="stylesheet" type="text/css" href="{{ asset('packages/adminty/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('packages/adminty/bower_components/multiselect/css/multi-select.css') }}">
@endpush
@push('after-scripts')
    {{--Select 2 js--}}
    <script type="text/javascript" src="{{ asset('packages/adminty/bower_components/select2/js/select2.full.min.js') }}"></script>
    {{--Multiselect js--}}
    <script type="text/javascript" src="{{ asset('packages/adminty/bower_components/bootstrap-multiselect/js/bootstrap-multiselect.js') }}"></script>
    {{--Custom js--}}
    <script>
        $(function(){
            $(".js-example-basic-multiple").select2({
                data: {!! $dataSelect !!}
            });
        });
    </script>
@endpush
