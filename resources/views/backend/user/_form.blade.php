<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    {!! Form::label("name", 'Имя', ['class' => 'control-label']) !!}
                    {!! Form::text("name", null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label("lastName", 'Фамилия', ['class' => 'control-label']) !!}
                    {!! Form::text("lastName", null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label("email", 'E-mail', ['class' => 'control-label']) !!}
                    {!! Form::text("email", null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label("phone", 'Телефон', ['class' => 'control-label']) !!}
                    {!! Form::text("phone", null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label("password", 'Пароль', ['class' => 'control-label']) !!}
                    {!! Form::password("password", ['class' => 'form-control', 'value' => 'adsfasdfasdf']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label("password_confirmation", 'Повторите пароль', ['class' => 'control-label']) !!}
                    {!! Form::password("password_confirmation", ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    {!! Form::label("nameCompany", 'Наименование организации', ['class' => 'control-label']) !!}
                    {!! Form::text("company[nameCompany]", isset($user) ? $user->company->nameCompany : null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label("address", 'Юридический адрес', ['class' => 'control-label']) !!}
                    {!! Form::text("company[address]", isset($user) ? $user->company->address : null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label("inn", 'ИНН', ['class' => 'control-label']) !!}
                    {!! Form::text("company[inn]", isset($user) ? $user->company->inn : null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label("kpp", 'КПП', ['class' => 'control-label']) !!}
                    {!! Form::text("company[kpp]", isset($user) ? $user->company->kpp : null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label("nameBank", 'Наименование банка', ['class' => 'control-label']) !!}
                    {!! Form::text("company[nameBank]", isset($user) ? $user->company->nameBank : null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label("bik", 'БИК', ['class' => 'control-label']) !!}
                    {!! Form::text("company[bik]", isset($user) ? $user->company->bik : null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label("paymentAccount", 'Расчетный счет', ['class' => 'control-label']) !!}
                    {!! Form::text("company[paymentAccount]", isset($user) ? $user->company->paymentAccount : null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label("correlationAccount", 'Кор. счет', ['class' => 'control-label']) !!}
                    {!! Form::text("company[correlationAccount]", isset($user) ? $user->company->correlationAccount : null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <a href="{{ route('admin.user.index') }}" class="btn btn-primary">Отмена</a>
        {!! Form::submit($submit, ['class' => 'btn btn-success']) !!}
    </div>
</div>
