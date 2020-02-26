<div class="form-group">
    <label for="productModel">Код товара</label>
    <input name="model" class="form-control" id="productModel" type="text" placeholder="Код" value="{{ $product->model }}">
</div>
<div class="form-group">
    <label for="productPrice">Цена</label>
    <input name="price" class="form-control" id="productPrice" type="text" placeholder="Цена" value="{{ $product->price }}">
</div>
<div class="form-group">
    <label for="productQuantity">Количество</label>
    <input name="quantity" class="form-control" id="productQuantity" type="text" placeholder="Количество" value="{{ $product->quantity }}">
</div>
<div class="form-group">
    <label for="pageSelect">Главная категория</label>
    <select name="category_id" class="form-control" id="pageSelect">
        <option value="0">- Без категории</option>
        @foreach($categoryTree as $key => $category)
            <option value="{{ $key }}" {{ (isset($product) && $product->category_id == $key ? 'selected' : '') }}>{{ $category['title'] }}</option>
        @endforeach
    </select>
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
    <label style="display: block" for="switchPublic">Публикация</label>
    <input name="public" class="js-success" type="checkbox" id="switchPublic" {{ $product->public ? 'checked' : '' }}>
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