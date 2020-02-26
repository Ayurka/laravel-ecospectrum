<div class="categories">
    <div class="widget">
        <h3>Категории</h3>
        <ul>
            @foreach($categories as $category)
                <li><a href="{{ route('frontend.product', $category->url['url']) }}"><i class="far fa-check-square" style="display: none"></i><i class="far fa-square"></i> {{ $category->title }}</a></li>
            @endforeach
        </ul>
    </div>
</div>