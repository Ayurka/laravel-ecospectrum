@extends('backend.layouts.app')

@section('title', 'Категории')

@section('breadcrumbs', Breadcrumbs::view('breadcrumbs.backend', 'admin.category.index'))

@section('content')
    <div class="page-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <a href="{{ route('admin.category.create') }}">
                                    <button type="button" class="btn btn-primary f-left"> <i class="icofont icofont-plus m-r-5"></i> Добавить</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-block">
                        <table class="table table-responsive-sm table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Название</th>
                                <th>ЧПУ</th>
                                <th>Статус</th>
                                <th>Дата обновления</th>
                                <th>Дата создания</th>
                                <th style="white-space: nowrap; width: 1%;">Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->title }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>{!! $category->public ? '<span class="text-success">Опубликовано</span>' : '<span class="text-danger">Не опубликовано</span>' !!}</td>
                                    <td>{{ $category->updated_at }}</td>
                                    <td>{{ $category->created_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.category.edit', $category->id) }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Редактировать" class="m-r-10 text-dark">
                                            <i class="icofont icofont-ui-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.category.destroy', $category->id)}}" method="post" style="display: inline-block;">
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
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
