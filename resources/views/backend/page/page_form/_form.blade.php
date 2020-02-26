<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    {!! Form::label("title", 'Название', ['class' => 'control-label']) !!}
                    {!! Form::text("title", null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('slug', 'ЧПУ', ['class' => 'control-label']) !!}
                    {!! Form::text('slug', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('category', 'Категория') !!}
                    {!! Form::select('category_id', $categoryTree, null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('announcement', 'Краткое описание', ['class' => 'control-label']) !!}
                    {!! Form::textarea("announcement", null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('description', 'Полное описание', ['class' => 'control-label']) !!}
                    {!! Form::textarea("description", null, ['class' => 'form-control editor']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('seo_title', 'SEO название страницы', ['class' => 'control-label']) !!}
                    {!! Form::text("seo_title", null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('seo_keywords', 'SEO ключевые слова', ['class' => 'control-label']) !!}
                    {!! Form::text("seo_keywords", null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('seo_description', 'SEO описание', ['class' => 'control-label']) !!}
                    {!! Form::textarea("seo_description", null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('images', 'Изображения', ['class' => 'control-label']) !!}
                    {!! Form::images('images[]', isset($preview) ? $preview : null, ['id' => 'images', 'multiple' => true]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('public', 'Публикация', ['style' => 'display: block']) !!}
                    {!! Form::checkbox('public', null, null, ['class' => 'js-success']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <a href="{{ route('admin.page.index') }}" class="btn btn-primary">Отмена</a>
        {!! Form::submit($submit, ['class' => 'btn btn-success']) !!}
    </div>
</div>
