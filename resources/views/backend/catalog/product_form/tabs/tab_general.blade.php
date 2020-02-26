<div class="form-group">
    {!! Form::label("title", 'Название', ['class' => 'control-label']) !!}
    {!! Form::text("title", null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('slug', 'ЧПУ', ['class' => 'control-label']) !!}
    {!! Form::text('slug', null, ['class' => 'form-control']) !!}
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
