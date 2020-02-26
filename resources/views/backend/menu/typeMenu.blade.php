@if($items === 'catalog' || $items === 'contact' || $items === 'link')
    @if($items === 'link')
        <div class="form-group">
            <label for="link">Ссылка</label>
            <input class="form-control" name="slug" id="link" type="text" placeholder="Введите ссылку" value="{{ isset($model) ? $model->slug : '' }}">
        </div>
    @endif
@else
    <div class="form-group">
        <label for="selectModel">Выберите</label>
        <select name="slug" class="form-control" id="selectModel">
            @foreach($items as $key => $item)
                <option value="{{ $item->url['url'] }}" {{ (isset($model) && $model->slug === $item->slug) ? 'selected' : '' }}>{{ $item->title }}</option>
            @endforeach
        </select>
    </div>
@endif