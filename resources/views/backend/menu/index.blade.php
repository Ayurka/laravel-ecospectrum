@extends('backend.layouts.app')

@section('title', 'Меню')

@section('breadcrumbs', Breadcrumbs::view('breadcrumbs.backend', 'admin.menu.index'))

@section('content')
    <div class="page-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h4>Меню</h4>
                            </div>
                            <div class="col">
                                <a href="{{ route('admin.menu.create') }}">
                                    <button type="button" class="btn btn-primary waves-effect waves-light f-right d-inline-block md-trigger"> <i class="icofont icofont-plus m-r-5"></i> Создать</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="row">
                            <div class="col-lg-12 col-sm-12">
                                <div class="cf nestable-lists">
                                    @if (count($menus) > 0)
                                        <div class="dd" id="nestable">
                                            <ol class="dd-list">
                                                @foreach($menus as $menu)
                                                    @include('backend.menu.partials.menu', $menu)
                                                @endforeach
                                            </ol>
                                        </div>
                                    @else
                                        <p>Пока нет меню</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('after-styles')
        <link type="text/css" rel="stylesheet" href="{{ asset('packages/adminty/assets/pages/nestable/nestable.css') }}">
        <style>
            .dd3-content{height: 40px;}
            .dd-handle{height: 40px; padding-top: 9px;}
            .dd3-item > button{margin:0;}
            .dd-item > button:before{content: none!important;}
        </style>
    @endpush
    @push('after-scripts')
        <script src="{{ asset('packages/adminty/assets/pages/nestable/jquery.nestable.js') }}"></script>
        <script type="text/javascript">
            $(function() {

                $('#nestable').nestable({
                    group: 1,
                    maxDepth: 2
                });

                $('.dd').on('change', function() {

                    let items = $('.dd').nestable('serialize');

                    console.log(items);

                    $.ajax({
                        url: '{{ route('admin.menuSort') }}',
                        method: 'POST',
                        data: {items:items},
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(){
                            console.log('Успешно');
                        },
                        error: function(){
                            console.log('Ошибка на сервере');
                        }
                    });
                });

            });
        </script>
    @endpush
@endsection
