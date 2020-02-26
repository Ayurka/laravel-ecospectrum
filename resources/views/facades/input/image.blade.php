<div class="form-group">
    <label>{{ $label }}</label>
    <div class="file-loading">
        <input type="file" name="image" id="image">
    </div>
</div>
@push('after-scripts')
    <script type="text/javascript">
        $(function(){
            $("#image").fileinput({!! $conf !!});
        });
    </script>
@endpush