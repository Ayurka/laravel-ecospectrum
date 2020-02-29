<style>
    .product-attr tbody td{
        vertical-align: middle;
    }
</style>
@if($isAttributes)
<table class="table table-bordered product-attr">
    <thead>
    <tr>
        <th style="width: 20%;">Характеристика</th>
        <th style="width: 70%;">Текст</th>
        <th style="width: 10%;" class="text-center"><button type="button" class="btn btn-primary btn-attr-add"><i class="fas fa-plus"></i></button></th>
    </tr>
    </thead>
    <tbody>
    @php $i = 0; @endphp
    @foreach($product->getPivotAttributes as $attribute)
        <tr class="count_old">
            <td style="width: 20%;">
                <select class="attribute_product_old col-sm-12" name="attribute_product[{{ $i }}][id]">
                    @foreach($attributeGroups as $group)
                        <optgroup label="{{ $group['text'] }}">
                            @foreach($group['children'] as $attr)
                                <option value="{{ $attr['id'] }}" {{ ($attribute->id == $attr['id']) ? 'selected' : '' }}>{{ $attr['text'] }}</option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
            </td>
            <td style="width: 70%;"><textarea class="form-control" rows="3" name="attribute_product[{{ $i }}][text]">{{ $attribute->pivot->text }}</textarea></td>
            <td style="width: 10%;" class="text-center"><button type="button" class="btn btn-danger btn-sm text-white btn-delete"><i class="fas fa-trash-alt"></i></button></td>
        </tr>
        @php $i++; @endphp
    @endforeach
    </tbody>
</table>
@else
    <p>Нет параметров</p>
@endif
@push('after-styles')
    {{--Select 2 css--}}
    <link rel="stylesheet" href="{{ asset('packages/adminty/bower_components/select2/css/select2.min.css') }}">
@endpush
@push('after-scripts')
    {{--Select 2 js--}}
    <script type="text/javascript" src="{{ asset('packages/adminty/bower_components/select2/js/select2.full.min.js') }}"></script>
    {{--Custom js--}}
    <script>
        $(function(){
            let data = JSON.parse('{!! $attributeGroupsJson !!}');

            let count_old, i;

            if (count_old = $('.count_old').length) {
                i = count_old
            } else {
                i = 0;
            }

            $('.attribute_product_old').select2({
                theme: 'classic'
            });

            $('.product-attr').on('click', '.btn-attr-add', function(){

                let $this = $(this).closest('.product-attr').find('tbody');

                $this.append('' +
                    '<tr class="count_' + i + '">' +
                    '<td style="width: 20%;"><select class="attribute_product col-sm-12" name="attribute_product[' + i + '][id]"></select></td>' +
                    '<td style="width: 70%;"><textarea name="attribute_product[' + i + '][text]" class="form-control" rows="3"></textarea></td>' +
                    '<td style="width: 10%;" class="text-center"><button type="button" class="btn btn-danger btn-sm text-white btn-delete"><i class="fas fa-trash-alt"></i></button></td>' +
                    '</tr>'
                );

                $this.find('.count_' + i + ' select').select2({
                    data: data,
                    theme: 'classic'
                });

                i++;
            }).on('click', '.btn-delete', function(){
                $(this).closest('tr').remove();
            });
        });
    </script>
@endpush
