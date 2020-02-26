<div class="form-group">
    <label for="{{ $name }}Input">{{ $label }}</label>
    <textarea name="{{ $name }}" class="form-control" id="{{ $name }}Input" rows="3">{{ $value }}</textarea>
</div>
@push('after-scripts')
    <script type="text/javascript" src="{{ asset('packages/ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('packages/ckeditor/adapters/jquery.js') }}"></script>
    <script>
        $(function(){
            CKEDITOR.replaceClass( 'textarea', {filebrowserImageBrowseUrl: '/file-manager/ckeditor'});
        });
    </script>
@endpush
