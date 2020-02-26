<div class="news">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="h2-title">Новости</h2>
                <a href="#" class="news-all">Все новости <i class="fas fa-angle-right fa-sm"></i></a>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="news-slider">
                    @foreach($news as $new)
                    <div class="news-slider__item">
                        <div class="news-img-wrap"><a href="#"><img src="{!! $new->image ? $new->image->resize(298, 192) : '' !!}" class="img-fluid news-img"></a></div>
                        <div class="news-text-wrap">
                            <a href="#" class="news-text">{{ $new->title }}</a>
                            <div class="news-meta">
                                <div class="news-date">22.04.2019</div>
                                <div class="news-like"><i class="far fa-thumbs-up"></i> 3</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>