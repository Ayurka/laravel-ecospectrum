@extends('backend.layouts.app')

@section('title', 'Информация по пользователю')

@section('breadcrumbs', Breadcrumbs::view('breadcrumbs.backend', 'admin.user.show', $user->id))

@section('content')

    <div class="page-body">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-2 text-muted">Данные пользователя</h5>
                        <p class="leader-dot">
                            <span class="leader-dot-left">Имя</span>
                            <span class="leader-dot-right">{{ $user->name }}</span>
                        </p>
                        <p class="leader-dot">
                            <span class="leader-dot-left">Фамилия</span>
                            <span class="leader-dot-right">{{ $user->lastName }}</span>
                        </p>
                        <p class="leader-dot">
                            <span class="leader-dot-left">E-mail</span>
                            <span class="leader-dot-right">{{ $user->email }}</span>
                        </p>
                        <p class="leader-dot">
                            <span class="leader-dot-left">Телефон</span>
                            <span class="leader-dot-right">{{ $user->phone }}</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-2 text-muted">Реквизиты компании</h5>
                        <p class="leader-dot">
                            <span class="leader-dot-left">Наименование организации</span>
                            <span class="leader-dot-right">{{ $user->company->nameCompany }}</span>
                        </p>
                        <p class="leader-dot">
                            <span class="leader-dot-left">Юридический адрес</span>
                            <span class="leader-dot-right">{{ $user->company->address }}</span>
                        </p>
                        <p class="leader-dot">
                            <span class="leader-dot-left">ИНН</span>
                            <span class="leader-dot-right">{{ $user->company->inn }}</span>
                        </p>
                        <p class="leader-dot">
                            <span class="leader-dot-left">КПП</span>
                            <span class="leader-dot-right">{{ $user->company->kpp }}</span>
                        </p>
                        <p class="leader-dot">
                            <span class="leader-dot-left">Наименование банка</span>
                            <span class="leader-dot-right">{{ $user->company->nameBank }}</span>
                        </p>
                        <p class="leader-dot">
                            <span class="leader-dot-left">БИК</span>
                            <span class="leader-dot-right">{{ $user->company->bik }}</span>
                        </p>
                        <p class="leader-dot">
                            <span class="leader-dot-left">Расчетный счет</span>
                            <span class="leader-dot-right">{{ $user->company->paymentAccount }}</span>
                        </p>
                        <p class="leader-dot">
                            <span class="leader-dot-left">Кор. счет</span>
                            <span class="leader-dot-right">{{ $user->company->correlationAccount }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
