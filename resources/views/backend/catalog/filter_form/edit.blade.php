@extends('backend.layouts.app')

@section('title', 'Редактирование фильтров')

@section('breadcrumbs', Breadcrumbs::view('breadcrumbs.backend', 'admin.filter.edit', $group->id))

@section('content')

    <div class="page-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h4>Редактирование фильтров</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form class="form-attr">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="attrGroup">Название группы</label>
                                <input name="title_group" class="form-control title-group" data-id="{{ $group->id }}" id="attrGroup" type="text" placeholder="Название группы" value="{{ $group->title }}">
                            </div>
                            <div class="container-attr">
                                <div>
                                    <label>Фильтры</label>
                                </div>
                                <button type="button" class="btn btn-primary m-b-15 btn-md btn-add-input">Создать</button>
                                <div id="items">
                                    @foreach($group->filters as $filter)
                                        <div class="form-group block-list title-old" data-id="{{ $filter->id }}" data-position="{{ $filter->position }}">
                                            <div class="row align-items-center">
                                                <div class="col-auto handle-sort"><i class="fas fa-arrows-alt"></i></div>
                                                <div class="col">
                                                    <input name="title[]" class="form-control" type="text" placeholder="Название характеристики" value="{{ $filter->title }}">
                                                </div>
                                                <div class="col-auto">
                                                    <button type="button" class="btn btn-danger btn-sm delete-attr-old">Удалить</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group">
                                <a href="{{ route('admin.filter.index') }}" class="btn btn-primary btn-md">Отмена</a>
                                <button type="button" class="btn btn-success btn-md btn-save">Сохранить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('after-styles')
        <!-- notify js Fremwork -->
        <link rel="stylesheet" type="text/css" href="{{ asset('packages/adminty/bower_components/pnotify/css/pnotify.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('packages/adminty/bower_components/pnotify/css/pnotify.brighttheme.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('packages/adminty/bower_components/pnotify/css/pnotify.buttons.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('packages/adminty/assets/pages/pnotify/notify.css') }}">
    @endpush
    @push('after-scripts')
        {{--<script type="text/javascript" src="{{ asset('packages/kartik/js/plugins/sortable.min.js') }}"></script>--}}
        <script type="text/javascript" src="{{ asset('packages/adminty/bower_components/pnotify/js/pnotify.js') }}"></script>
        <script type="text/javascript" src="{{ asset('packages/adminty/bower_components/pnotify/js/pnotify.buttons.js') }}"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.6.0/Sortable.js"></script>
        <script type="text/javascript">
            $(function(){
                $('.container-attr').on('click', '.btn-add-input', function(){
                    let $this = $(this).closest('.container-attr').find('#items'),
                        position = $this.find('.block-list').length;

                    $this.append('' +
                        '<div class="form-group block-list title-new" data-position="' + position + '">' +
                            '<div class="row align-items-center">' +
                                '<div class="col-auto handle-sort"><i class="fas fa-arrows-alt"></i></div>' +
                                '<div class="col"><input name="title[]" class="form-control" type="text" placeholder="Название филльтра"></div>' +
                                '<div class="col-auto"><button type="button" class="btn btn-danger btn-sm delete-attr-new">Удалить</button></div>' +
                            '</div>' +
                        '</div>');

                }).on('click', '.delete-attr-new', function(){
                    let $this = $(this).closest('.block-list');
                    $this.remove();
                    [].forEach.call(document.getElementsByClassName('block-list'), function (el, index) {
                        el.setAttribute("data-position", index);
                    });
                }).on('click', '.delete-attr-old', function(){
                    let $this = $(this).closest('.block-list'),
                        id = $this.attr('data-id');

                    $.ajax({
                        url: '{{ route('admin.filterDelete') }}',
                        method: 'GET',
                        data: {id: id},
                        success: function(data){
                            if(data.status === 'success'){
                                $this.remove();
                                new PNotify({
                                    title: 'Success!',
                                    text: 'Успешно удален',
                                    icon: 'fas fa-check-circle',
                                    type: 'success'
                                });
                                [].forEach.call(document.getElementsByClassName('block-list'), function (el, index) {
                                    el.setAttribute("data-position", index);
                                });
                            }
                        },
                        error: function(){
                            new PNotify({
                                title: 'Error!',
                                text: 'Ошибка на сервере',
                                icon: 'fas fa-exclamation-circle',
                                type: 'error'
                            });
                        }
                    });
                });

                $('.form-attr').on('click', '.btn-save', function(event){
                    event.preventDefault();

                    let $form = $(this).closest('.form-attr'),
                        title_group = $form.find('.title-group').val(),
                        attribute_old = $form.find('.title-old'),
                        attribute_new = $form.find('.title-new');

                    let attr_old = [],
                        attr_new = [];

                    attribute_old.each(function(index, element){
                        attr_old.push(
                            {
                                id: $(element).attr('data-id'),
                                value: $(element).find('input').val(),
                                position: $(element).attr('data-position')
                            }
                        );
                    });

                    attribute_new.each(function(index, element){
                        attr_new.push(
                            {
                                value: $(element).find('input').val(),
                                position: $(element).attr('data-position')
                            }
                        );
                    });

                    $.ajax({
                        url: '{{ route('admin.filter.update', $group->id) }}',
                        method: 'PATCH',
                        data: {
                            title_group: title_group,
                            attr_old: attr_old,
                            attr_new: attr_new
                        },
                        dataType: 'json',
                        encode  : true,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            if(data.status === 'success'){
                                document.location.href="{{ route('admin.filter.index') }}";
                            }
                        },
                        error: function() {
                            new PNotify({
                                title: 'Error!',
                                text: 'Необходимо заполнить все поля',
                                icon: 'fas fa-exclamation-circle',
                                type: 'error'
                            });
                        }
                    });
                });

                var el = document.getElementById('items');

                new Sortable(el, {
                    handle: '.handle-sort',
                    animation: 150,
                    draggable: '.block-list',
                    onUpdate: function (evt) {
                        [].forEach.call(evt.from.getElementsByClassName('block-list'), function (el, index) {
                            el.setAttribute("data-position", index);
                        });
                    }
                });
            });
        </script>
    @endpush
@endsection
