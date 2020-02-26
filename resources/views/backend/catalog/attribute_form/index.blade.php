@extends('backend.layouts.app')

@section('title', 'Характеристики')

@section('breadcrumbs', Breadcrumbs::view('breadcrumbs.backend', 'admin.attribute.index'))

@section('content')
    <div class="page-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h4>Характеристики</h4>
                            </div>
                            <div class="col">
                                <a href="{{ route('admin.attribute.create') }}">
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
                                <th>Группа характеристик</th>
                                <th>Характеристики</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($groups as $group)
                                <tr>
                                    <td>{{ $group->id }}</td>
                                    <td>{{ $group->title }}</td>
                                    <td>
                                        @foreach($group->attributes as $attribute)
                                            <span class="btn btn-info btn-sm">{{ $attribute->title }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.attribute.edit', ['id' => $group->id]) }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Редактировать" class="m-r-10 text-dark">
                                            <i class="icofont icofont-ui-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.attribute.destroy', $group->id)}}" method="post" style="display: inline-block;">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
