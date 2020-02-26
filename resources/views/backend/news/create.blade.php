@extends('backend.layouts.app')

@section('title', 'Создание новости')

@section('breadcrumbs', Breadcrumbs::view('breadcrumbs.backend', 'admin.news.create'))

@section('content')

    <div class="page-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h4>Создание новости</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['route' => 'admin.news.store', 'enctype' => true]) !!}
                            {!! Input::string('Название', 'title') !!}
                            {!! Input::string('ЧПУ', 'slug') !!}
                            {!! Input::image('Изображение') !!}
                            {!! Input::text('Краткое описание', 'announcement') !!}
                            {!! Input::ckeditor('Полное описание', 'description') !!}
                            {!! Input::switch('Публикация', 'public') !!}
                            {!! Input::string('SEO название страницы', 'seo_title') !!}
                            {!! Input::string('SEO ключевые слова', 'seo_keywords') !!}
                            {!! Input::text('SEO описание', 'seo_description') !!}
                            <div class="form-group">
                                <a href="{{ route('admin.news.index') }}" class="btn btn-primary btn-lg">Отмена</a>
                                <button type="submit" class="btn btn-success btn-lg">Сохранить</button>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
