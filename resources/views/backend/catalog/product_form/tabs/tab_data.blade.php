<div class="form-group">
    {!! Form::label("model", 'Код товара', ['class' => 'control-label']) !!}
    {!! Form::text("model", null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label("price", 'Цена', ['class' => 'control-label']) !!}
    {!! Form::text("price", null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label("quantity", 'Количество', ['class' => 'control-label']) !!}
    {!! Form::text("quantity", null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('category', 'Главная категория') !!}
    {!! Form::select('category_id', $categoryTree, null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label for="select2">Категории</label>
    <select class="js-example-basic-multiple col-sm-12" id="select2" name="categories[]" multiple="multiple"></select>
</div>
<div class="form-group">
    <label for="select2">Фильтры</label>
    <select class="filters-multiple col-sm-12" id="select2" name="filters[]" multiple="multiple"></select>
</div>
<div class="form-group">
    {!! Form::label('public', 'Публикация', ['style' => 'display: block']) !!}
    {!! Form::checkbox('public', null, null, ['class' => 'js-success']) !!}
</div>
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

            $(".filters-multiple").select2({
                data: {!! $filters !!}
            });
        });
    </script>
@endpush
