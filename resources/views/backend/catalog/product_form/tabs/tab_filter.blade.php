@if(isset($product->getCategory) && count($product->getCategory->getGroupsFilters) > 0)
    @foreach($product->getCategory->getGroupsFilters as $groupFilter)
        <div class="form-group p-0 col-3">
            <label for="">{{ $groupFilter->title }}</label>
            <select name="filters[]" class="form-control form-control">
                <option value="">Выберите</option>
                @foreach($groupFilter->filters as $filter)
                    <option value="{{ $filter->id }}" {{ $filter->getPivotProducts->contains($product->id) ? 'selected' : '' }}>{{ $filter->title }}</option>
                @endforeach
            </select>
        </div>
    @endforeach

@else
    <p>Нет фильтров</p>
@endif
