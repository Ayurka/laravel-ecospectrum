{{--
@if(!empty($data['id']))
    <form action="{{ route($data['route'], $data['id']) }}" method="post" {{ $data['enctype'] ? "enctype=multipart/form-data" : '' }}>
    @csrf
    @method('PATCH')
@else
    <form action="{{ route($data['route']) }}" method="post" {{ $data['enctype'] ? "enctype=multipart/form-data" : ''}}>
    @csrf
@endif

@if($data['enctype'])
    @push('after-styles')
        <link type="text/css" rel="stylesheet" href="{{ asset('packages/kartik/css/fileinput.min.css') }}">
    @endpush

    @push('after-scripts')
        <script type="text/javascript" src="{{ asset('packages/kartik/js/fileinput.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('packages/kartik/js/locales/ru.js') }}"></script>
        <script type="text/javascript" src="{{ asset('packages/kartik/js/plugins/sortable.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('packages/kartik/js/plugins/piexif.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('packages/kartik/js/plugins/purify.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('packages/kartik/themes/fas/theme.min.js') }}"></script>
    @endpush
@endif--}}
