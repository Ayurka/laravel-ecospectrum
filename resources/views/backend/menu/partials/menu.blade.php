<li class="dd-item dd3-item" data-id="{{ $menu->id }}">
    <div class="dd-handle dd3-handle">
        <i class="fas fa-arrows-alt"></i>
    </div>
    <div class="dd3-content">
        <div class="row" style="margin-right: 0; display: flex; align-items: center">
            <div class="col">{{ $menu->title }}</div>
            <div class="col-auto">-
                <a href="{{ route('admin.menu.edit', $menu->id) }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Редактировать" class="m-r-10 text-dark">
                    <i class="icofont icofont-ui-edit"></i>
                </a>
                <form action="{{ route('admin.menu.destroy', $menu->id)}}" method="post" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button class="btn-link text-dark" type="submit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Удалить" style="cursor: pointer;">
                        <i class="icofont icofont-ui-delete"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    @if(count($menu->children) > 0)
        <ol class="dd-list">
            @foreach($menu->children as $menu)
                @include('backend.menu.partials.menu', $menu)
            @endforeach
        </ol>
    @endif
</li>