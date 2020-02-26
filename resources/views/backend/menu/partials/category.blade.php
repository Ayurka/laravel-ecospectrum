<li class="dd-item dd3-item" data-id="{{ $category->id }}">
    <div class="dd-handle dd3-handle">
        <i class="fas fa-arrows-alt"></i>
    </div>
    <div class="dd3-content">
        <div class="row" style="margin-right: 0">
            <div class="col">{{ $category->title }}</div>
            <div class="col-auto">
                <a class="btn btn-primary category-edit" href="{{ route('admin.page_category.edit', $category->id) }}"><i class="fa fa-edit"></i></a>
                <form action="{{ route('admin.page_category.destroy', $category->id)}}" method="post" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger category-remove" type="submit"><i class="fa fa-trash-alt" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
    </div>

    @if(count($category->children) > 0)
        <ol class="dd-list">
            @foreach($category->children as $category)
                @include('backend.page_category.partials.category', $category)
            @endforeach
        </ol>
    @endif
</li>