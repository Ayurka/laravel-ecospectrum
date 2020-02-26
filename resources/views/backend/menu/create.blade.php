@extends('backend.layouts.app')

@section('title', 'Создание меню')

@section('breadcrumbs', Breadcrumbs::view('breadcrumbs.backend', 'admin.menu.create'))

@section('content')

    <div class="page-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h4>Создание меню</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.menu.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="menuTitle">Название</label>
                                <input name="title" class="form-control" id="menuTitle" type="text" placeholder="Название меню">
                            </div>
                            <div class="form-group">
                                <label for="typeMenuSelect">Тип меню</label>
                                <select name="type_menu" class="form-control" id="typeMenuSelect">
                                    <option value="select_type">Выберите тип меню</option>
                                    <option value="page">Страница</option>
                                    <option value="pageCategory">Категория страниц</option>
                                    <option value="catalog">Каталог</option>
                                    <option value="categoryProduct">Категория товаров</option>
                                    <option value="contact">Контакты</option>
                                    <option value="link">Ссылка</option>
                                </select>
                            </div>
                            <div class="dynamic-form"></div>
                            <div class="form-group">
                                <a href="{{ route('admin.menu.index') }}" class="btn btn-primary btn-lg">Отмена</a>
                                <button type="submit" class="btn btn-success btn-lg">Сохранить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('after-scripts')
        <script type="text/javascript">
            $(function(){
                $('form').on('change', '#typeMenuSelect', function(){
                    let type_menu = $(this).val(),
                        dynamic_form = $(this).closest('form').find('.dynamic-form');

                    dynamic_form.empty();

                    $.ajax({
                        url: '{{ route('admin.menuType') }}',
                        method: 'GET',
                        data: {type_menu: type_menu},
                        success: function(data){
                            if(data.status === 'success'){
                                dynamic_form.append(data.form);
                                console.log(data.form);
                            }else{
                                console.log('Ошибка');
                            }
                        },
                        error: function(){
                            console.log('Ошибка');
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
