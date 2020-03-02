@extends('backend.layouts.app')

@section('title', 'Заказы')

@section('breadcrumbs', Breadcrumbs::view('breadcrumbs.backend', 'admin.order.index'))

@section('content')
    <div class="page-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <a href="{{ route('admin.order.create') }}">
                                    <button type="button" class="btn btn-primary f-left"> <i class="icofont icofont-plus m-r-5"></i> Добавить</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-block">
                        <table class="table table-responsive-sm table-striped table-list">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Имя</th>
                                <th>Компания</th>
                                <th>Количество</th>
                                <th>Сумма</th>
                                <th>Статус</th>
                                <th>Дата создания</th>
                                <th style="white-space: nowrap; width: 1%;">Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->user->name }}</td>
                                    <td>{{ $order->user->company->nameCompany }}</td>
                                    <td>{{ $order->quantity }}</td>
                                    <td>{{ $order->total }} руб.</td>
                                    <td>{{ $order->status }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.order.show', $order->id) }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Просмотр" class="m-r-10 text-dark">
                                            <i class="icofont icofont-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.order.edit', $order->id) }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Редактировать" class="m-r-10 text-dark">
                                            <i class="icofont icofont-ui-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.order.destroy', $order->id)}}" method="post" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn-link text-dark" type="submit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Удалить" style="cursor: pointer;">
                                                <i class="icofont icofont-ui-delete"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
