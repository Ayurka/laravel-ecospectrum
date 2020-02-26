<div class="form-group">
    <label>{{ $label }}</label>
    <div class="file-loading">
        <input type="file" name="images[]" id="images" multiple>
    </div>
</div>
@push('after-scripts')
    <script type="text/javascript">
        $(function(){
            $("#images").fileinput({!! $conf !!}).on('filesorted', function(event, params) {
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