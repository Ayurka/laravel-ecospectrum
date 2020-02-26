<div class="file-loading">
    {{ Form::file($name, array_merge(['class' => 'form-control'], $attributes)) }}
</div>
@push('after-styles')
    <link type="text/css" rel="stylesheet" href="{{ asset('packages/kartik/css/fileinput.min.css') }}">
@endpush

@push('after-scripts')
    <script type="text/javascript" src="{{ asset('packages/kartik/js/fileinput.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/kartik/js/locales/ru.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/kartik/js/plugins/sortable.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/kartik/js/plugins/piexif.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/kartik/js/plugins/purify.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/kartik/themes/fas/theme.min.js') }}"></script>

    <script>
        $(function(){
            $("#images").fileinput({!! $value !!}).on('filesorted', function(event, params) {
                //console.log('File sorted ', params.oldIndex, params.newIndex, params.stack);
                $.ajax({
                    url: '{{ route('admin.image_sort') }}',
                    method: 'post',
                    data: {
                        param: params.stack
                    },
                    dataType: 'json',
                    encode  : true,
                    headers: {
                        'X-CSRF-TOKEN': $("input[name='_token']").val()
                    },
                    success: function(data){
                        console.log('Сортировка успешно изменена')
                    },
                    error: function(){console.log('Ошибка на сервере')}
                });
            });
        });
    </script>
@endpush
