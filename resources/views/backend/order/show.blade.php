@extends('backend.layouts.app')

@section('title', 'Информация по заказу')

@section('breadcrumbs', Breadcrumbs::view('breadcrumbs.backend', 'admin.order.show', $order->id))

@section('content')

    <div class="page-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-2 text-muted">Товары</h5>
                        <div class="form-group">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Изображение</th>
                                    <th>Товар</th>
                                    <th>Количество</th>
                                    <th>Цена</th>
                                    <th>Сумма</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order->products as $product)
                                    <tr>
                                        <td><img src="{!! $product->image ? $product->image['small'] : '/images/no-photo.png' !!}" width="50" alt=""></td>
                                        <td style="width: 100%">{{ $product->title }}</td>
                                        <td>{{ $product->pivot->quantity }} шт.</td>
                                        <td>{{ $product->price }} руб.</td>
                                        <td>{!! $product->price * $product->pivot->quantity !!} руб.</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4" class="text-right font-weight-bold">Итого:</td>
                                    <td class="font-weight-bold">{{ $order->total }} руб.</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-2 text-muted">Пользователь</h5>
                        <p class="leader-dot">
                            <span class="leader-dot-left">Имя</span>
                            <span class="leader-dot-right">{{ $order->user->name }}</span>
                        </p>
                        <p class="leader-dot">
                            <span class="leader-dot-left">Фамилия</span>
                            <span class="leader-dot-right">{{ $order->user->lastName }}</span>
                        </p>
                        <p class="leader-dot">
                            <span class="leader-dot-left">E-mail</span>
                            <span class="leader-dot-right">{{ $order->user->email }}</span>
                        </p>
                        <p class="leader-dot">
                            <span class="leader-dot-left">Телефон</span>
                            <span class="leader-dot-right">{{ $order->user->phone }}</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-2 text-muted">Реквизиты</h5>
                        <p class="leader-dot">
                            <span class="leader-dot-left">Наименование организации</span>
                            <span class="leader-dot-right">{{ $order->user->company->nameCompany }}</span>
                        </p>
                        <p class="leader-dot">
                            <span class="leader-dot-left">Юридический адрес</span>
                            <span class="leader-dot-right">{{ $order->user->company->address }}</span>
                        </p>
                        <p class="leader-dot">
                            <span class="leader-dot-left">ИНН</span>
                            <span class="leader-dot-right">{{ $order->user->company->inn }}</span>
                        </p>
                        <p class="leader-dot">
                            <span class="leader-dot-left">КПП</span>
                            <span class="leader-dot-right">{{ $order->user->company->kpp }}</span>
                        </p>
                        <p class="leader-dot">
                            <span class="leader-dot-left">Наименование банка</span>
                            <span class="leader-dot-right">{{ $order->user->company->nameBank }}</span>
                        </p>
                        <p class="leader-dot">
                            <span class="leader-dot-left">БИК</span>
                            <span class="leader-dot-right">{{ $order->user->company->bik }}</span>
                        </p>
                        <p class="leader-dot">
                            <span class="leader-dot-left">Расчетный счет</span>
                            <span class="leader-dot-right">{{ $order->user->company->paymentAccount }}</span>
                        </p>
                        <p class="leader-dot">
                            <span class="leader-dot-left">Кор. счет</span>
                            <span class="leader-dot-right">{{ $order->user->company->correlationAccount }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
