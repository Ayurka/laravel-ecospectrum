<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <a href="{{ route('admin.order.index') }}" class="btn btn-primary">Отмена</a>
        {!! Form::submit($submit, ['class' => 'btn btn-success']) !!}
    </div>
</div>
