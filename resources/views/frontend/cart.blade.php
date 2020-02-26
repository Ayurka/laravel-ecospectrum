@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">{{ Breadcrumbs::render('cart') }}</div>
        </div>
        <div class="row">
            <div class="col">
                <h1 class="h1-title">Оформление заказа</h1>
                <hr>
                <div id="app-cart">
                    <div class="row">
                        <div class="col">
                            <div class="cart-block">
                                @php $total = 0; @endphp
                                @if(session('cart'))
                                    <table class="table table-bordered table-striped cart-table">
                                        <thead>
                                        <tr>
                                            <th class="text-center">Фото товара</th>
                                            <th>Название</th>
                                            <th>Цена (руб.)</th>
                                            <th>Количество</th>
                                            <th>Сумма (руб.)</th>
                                            <th class="text-center">Удалить</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach(session('cart') as $id => $item)
                                            @php $total += $item['price'] * $item['quantity'] @endphp
                                            <tr class="cart-item" data-id="{{ $id }}">
                                                <td class="text-center"><img src="{!! $item['image'] !!}" class="img-fluid" width="50"></td>
                                                <td>{{ $item['title'] }}</td>
                                                <td class="cart-item-price">{{ $item['price'] }}</td>
                                                <td><input type="number" class="form-control cart-item-quantity" value="{{ $item['quantity'] }}" min="100"></td>
                                                <td class="cart-item-subtotal">{{ $item['price'] * $item['quantity'] }}</td>
                                                <td class="text-center">
                                                    <button class="btn btn-dark cart-btn-remove" data-id="{{ $id }}"><i class="fas fa-times fa-sm"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <p>Итого: {{ $total }} руб.</p>
                                @else
                                    <h3 class="text-center">Нет товаров в корзине</h3>
                                @endif
                            </div>
                            <div class="vue-block">
                                <cart-component></cart-component>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection