@extends('backend.layouts.app')

@section('title', 'Редактирование пользователя')

@section('breadcrumbs', Breadcrumbs::view('breadcrumbs.backend', 'admin.user.edit', $user->id))

@section('content')

    <div class="page-body">
        {!! Form::model($user, ['method' => 'put', 'route' => ['admin.user.update', $user->id], 'files' => true]) !!}
        @include('backend.user._form', ['submit' => 'Обновить'])
        {!! Form::close() !!}
    </div>
@endsection
