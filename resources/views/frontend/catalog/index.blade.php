@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">{{ Breadcrumbs::render('catalog') }}</div>
        </div>
        <div class="row">
            <div class="col">
                <div class="row align-items-center">
                    <div class="col">
                        <h1 class="h1-title">Каталог</h1>
                    </div>
                    <div class="col-auto">
                        <div class="cart-head">
                            <a href="{{ route('frontend.cart') }}" class="text-dark"><i class="fas fa-cart-plus fa-2x"></i></a>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-3">
                        @widget('categories')
                    </div>
                    <div class="col-9">
                        <div class="catalog-table">
                            <div class="catalog-row catalog-row-th">
                                <div class="catalog-th">Фото товара</div>
                                <div class="catalog-th">Название товара</div>
                                <div class="catalog-th">Стоимость в RUB</div>
                                <div class="catalog-th">Партия, в шт.</div>
                                <div class="catalog-th">Добавь товар</div>
                            </div>
                            @foreach($products as $product)
                                <div class="catalog-row catalog-row-td product-item" data-id="{{ $product->id }}">
                                    <div class="catalog-td">
                                        <a href="{{ route('frontend.product', $product->url['url']) }}"><img src="{!! $product->image->resize(150, 150) !!}" class="img-thumbnail"></a>
                                    </div>
                                    <div class="catalog-td">
                                        <div>
                                            <p>{{ $product->title }}</p>
                                            <a href="{{ route('frontend.product', $product->url['url']) }}" class="btn btn-grey">Подробнее</a>
                                        </div>
                                    </div>
                                    <div class="catalog-td">{{ $product->price }} RUB</div>
                                    <div class="catalog-td"><input type="text" name="count" class="form-control product-quantity" title="Минимальная партия" placeholder="100" value="100"></div>
                                    <div class="catalog-td"><button href="#" type="button" class="btn btn-dark btn-to-cart"><i class="fas fa-cart-plus"></i> добавить</button></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection