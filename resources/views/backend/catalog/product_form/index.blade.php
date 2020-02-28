@extends('backend.layouts.app')

@section('title', 'Товары')

@section('breadcrumbs', Breadcrumbs::view('breadcrumbs.backend', 'admin.product.index'))

@section('content')
    <div class="page-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <a href="{{ route('admin.product.create') }}">
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
                                <th>Изображение</th>
                                <th>Название</th>
                                <th>Категория</th>
                                <th>Цена</th>
                                <th>Статус</th>
                                <th>Дата создания</th>
                                <th style="white-space: nowrap; width: 1%;">Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td><img src="{!! $product->image['small'] !!}" width="50" alt=""></td>
                                    <td>{{ $product->title }}</td>
                                    <td>{{ $product->getCategory ? $product->getCategory['title'] : 'Без категории' }}</td>
                                    <td>{{ $product->price . ' руб.' }}</td>
                                    <td>{!! $product->public ? '<span class="text-success">Опубликовано</span>' : '<span class="text-danger">Не опубликовано</span>' !!}</td>
                                    <td>{{ $product->created_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.product.edit', $product->id) }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Редактировать" class="m-r-10 text-dark">
                                            <i class="icofont icofont-ui-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.product.destroy', $product->id)}}" method="post" style="display: inline-block;">
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
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
