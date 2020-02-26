@extends('backend.layouts.app')

@section('title', 'Файловый менеджер')

@section('breadcrumbs', Breadcrumbs::view('breadcrumbs.backend', 'admin.file_manager'))

@section('content')

    <div class="page-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h4>Файловый менеджер</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="height: 700px;">
                            <div id="fm"></div>
                        </div>

                        @push('after-styles')
                            <link type="text/css" rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
                        @endpush

                        @push('after-scripts')
                            <script type="text/javascript" src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
                        @endpush

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
