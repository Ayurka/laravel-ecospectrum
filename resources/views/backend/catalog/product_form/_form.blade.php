<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tab-general" role="tab">Общие</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tab-data" role="tab">Данные</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tab-attribute" role="tab">Характеристики</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tab-image" role="tab">Изображения</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tab-filter" role="tab">Фильтр</a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content tabs card-block">
                            <div class="tab-pane active" id="tab-general" role="tabpanel">
                                @include('backend.catalog.product_form.tabs.tab_general')
                            </div>
                            <div class="tab-pane" id="tab-data" role="tabpanel">
                                @include('backend.catalog.product_form.tabs.tab_data', [$dataSelect])
                            </div>
                            <div class="tab-pane" id="tab-attribute" role="tabpanel">
                                @include('backend.catalog.product_form.tabs.tab_attribute', [$attributeGroups])
                            </div>
                            <div class="tab-pane" id="tab-image" role="tabpanel">
                                @include('backend.catalog.product_form.tabs.tab_image')
                            </div>
                            <div class="tab-pane" id="tab-filter" role="tabpanel">
                                @include('backend.catalog.product_form.tabs.tab_filter')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <a href="{{ route('admin.product.index') }}" class="btn btn-primary">Отмена</a>
        {!! Form::submit($submit, ['class' => 'btn btn-success']) !!}
    </div>
</div>
