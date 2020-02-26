{{--<div class="form-group">--}}
{{--    <label>Главное изображение</label>--}}
{{--    <div class="file-loading">--}}
{{--        <input type="file" name="image" id="image">--}}
{{--    </div>--}}
{{--</div>--}}
<div class="form-group">
    {!! Form::label('images', 'Дополнительные изображения', ['class' => 'control-label']) !!}
    {!! Form::images('images[]', isset($preview) ? $preview : null, ['id' => 'images', 'multiple' => true]) !!}
</div>
