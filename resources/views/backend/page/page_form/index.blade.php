@extends('backend.layouts.app')

@section('title', 'Страницы')

@section('breadcrumbs', Breadcrumbs::view('breadcrumbs.backend', 'admin.page.index'))

@section('content')
    <div class="page-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <a href="{{ route('admin.page.create') }}">
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
                                    <th>Категория</th>
                                    <th>ЧПУ</th>
                                    <th>Статус</th>
                                    <th>Дата создания</th>
                                    <th style="white-space: nowrap; width: 1%;">Действие</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($pages as $page)
                                <tr>
                                    <td>{{ $page->id }}</td>
                                    <td>{{ $page->title }}</td>
                                    <td>{{ $page->category ? $page->category->title : 'Без категории' }}</td>
                                    <td>{{ $page->slug }}</td>
                                    <td>{!! $page->public ? '<span class="text-success">Опубликовано</span>' : '<span class="text-danger">Не опубликовано</span>' !!}</td>
                                    <td>{{ $page->created_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.page.edit', $page->id) }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Редактировать" class="m-r-10 text-dark">
                                            <i class="icofont icofont-ui-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.page.destroy', $page->id)}}" method="post" style="display: inline-block;">
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
                        {{ $pages->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
