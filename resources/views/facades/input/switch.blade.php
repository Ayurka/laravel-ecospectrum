<div class="form-group">
    <label style="display: block" for="switchPublic">{{ $label }}</label>
    <input name="{{ $name }}" class="js-success" type="checkbox" id="switchPublic" {{ $value != '' ? 'checked' : '' }}>
</div>