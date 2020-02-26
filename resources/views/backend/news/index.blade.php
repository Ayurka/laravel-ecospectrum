@extends('backend.layouts.app')

@section('title', 'Новости')

@section('breadcrumbs', Breadcrumbs::view('breadcrumbs.backend', 'admin.news.index'))

@section('content')
    <div class="page-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h4>Новости</h4>
                            </div>
                            <div class="col">
                                <a href="{{ route('admin.news.create') }}">
                                    <button type="button" class="btn btn-primary waves-effect waves-light f-right d-inline-block md-trigger"> <i class="icofont icofont-plus m-r-5"></i> Создать</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-block">
                        <table class="table table-responsive-sm table-striped">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Название</th>
                                    <th>ЧПУ</th>
                                    <th>Статус</th>
                                    <th>Дата создания</th>
                                    <th>Действие</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($news as $new)
                                <tr>
                                    <td>{{ $new->id }}</td>
                                    <td>{{ $new->title }}</td>
                                    <td>{{ $new->slug }}</td>
                                    <td>{!! $new->public ? '<span class="text-success">Опубликовано</span>' : '<span class="text-danger">Не опубликовано</span>' !!}</td>
                                    <td>{{ $new->created_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.news.edit', ['id' => $new->id]) }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Редактировать" class="m-r-10 text-dark">
                                            <i class="icofont icofont-ui-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.news.destroy', $new->id)}}" method="post" style="display: inline-block;">
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
                        {{ $news->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
