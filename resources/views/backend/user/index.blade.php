@extends('backend.layouts.app')

@section('title', 'Пользователи')

@section('breadcrumbs', Breadcrumbs::view('breadcrumbs.backend', 'admin.user.index'))

@section('content')
    <div class="page-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <a href="{{ route('admin.user.create') }}">
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
                                <th>Фамилия</th>
                                <th>E-mail</th>
                                <th>Телефон</th>
                                <th>Дата создания</th>
                                <th style="white-space: nowrap; width: 1%;">Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->lastName }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.user.show', $user->id) }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Просмотр" class="m-r-10 text-dark">
                                            <i class="icofont icofont-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.user.edit', $user->id) }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Редактировать" class="m-r-10 text-dark">
                                            <i class="icofont icofont-ui-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.user.destroy', $user->id)}}" method="post" style="display: inline-block;">
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
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
