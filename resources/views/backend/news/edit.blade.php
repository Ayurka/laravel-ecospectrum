@extends('backend.layouts.app')

@section('title', 'Редактирование новости')

@section('breadcrumbs', Breadcrumbs::view('breadcrumbs.backend', 'admin.news.edit', $new->id))

@section('content')

    <div class="page-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h4>Редактирование новости "{{ $new->title }}"</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['route' => 'admin.news.update', 'id' => $new->id, 'enctype' => true]) !!}
                            {!! Input::string('Название', 'title', $new->title) !!}
                            {!! Input::string('ЧПУ', 'slug', $new->slug) !!}
                            {!! Input::image('Изображение', $initialPreviewFirst, $initialPreviewConfigFirst) !!}
                            {!! Input::text('Краткое описание', 'announcement', $new->announcement) !!}
                            {!! Input::ckeditor('Полное описание', 'description', $new->description) !!}
                            {!! Input::switch('Публикация', 'public', $new->public) !!}
                            {!! Input::string('SEO название страницы', 'seo_title', $new->seo_title) !!}
                            {!! Input::string('SEO ключевые слова', 'seo_keywords', $new->seo_keywords) !!}
                            {!! Input::text('SEO описание', 'seo_description', $new->seo_description) !!}
                            <div class="form-group">
                                <a href="{{ route('admin.news.index') }}" class="btn btn-primary btn-lg">Отмена</a>
                                <button type="submit" class="btn btn-success btn-lg">Обновить</button>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
