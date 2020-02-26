<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>@yield('title')</title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
    <!-- Meta -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    @stack('before-styles')

    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('packages/adminty/assets/images/favicon.ico') }}" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{ asset('packages/adminty/bower_components/bootstrap/css/bootstrap.min.css') }}">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('packages/adminty/assets/icon/themify-icons/themify-icons.css') }}">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{{ asset('packages/adminty/assets/icon/icofont/css/icofont.css') }}">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="{{ asset('packages/adminty/assets/icon/feather/css/feather.css') }}">
    <!-- Switch component css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('packages/adminty/bower_components/switchery/css/switchery.min.css') }}">

    @stack('after-styles')

    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('packages/adminty/assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/backend.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('packages/adminty/assets/css/jquery.mCustomScrollbar.css') }}">
</head>

<body>
<!-- Pre-loader start -->
@include('backend.partials.loader')
<!-- Pre-loader end -->
<div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">

        @include('backend.partials.header')
        <div class="pcoded-main-container">
            <div class="pcoded-wrapper">
                @include('backend.partials.left_menu')
                <div class="pcoded-content">
                    <div class="pcoded-inner-content">
                        <!-- Main-body start -->
                        <div class="main-body">
                            <div class="page-wrapper">
                                @yield('breadcrumbs')
                                @include('includes.partials.messages')
                                @yield('content')
                            </div>
                        </div>
                        <!-- Main-body start -->

                        <div id="styleSelector">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stack('before-scripts')

<!-- Required Jquery -->
<script type="text/javascript" src="{{ asset('packages/adminty/bower_components/jquery/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('packages/adminty/bower_components/jquery-ui/js/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('packages/adminty/bower_components/popper.js/js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('packages/adminty/bower_components/bootstrap/js/bootstrap.min.js') }}"></script>

<!-- jquery slimscroll js -->
<script type="text/javascript" src="{{ asset('packages/adminty/bower_components/jquery-slimscroll/js/jquery.slimscroll.js') }}"></script>

<!-- modernizr js -->
<script type="text/javascript" src="{{ asset('packages/adminty/bower_components/modernizr/js/modernizr.js') }}"></script>
<script type="text/javascript" src="{{ asset('packages/adminty/bower_components/modernizr/js/css-scrollbars.js') }}"></script>

<!-- Switch component js -->
<script type="text/javascript" src="{{ asset('packages/adminty/bower_components/switchery/js/switchery.min.js') }}"></script>

<!-- Tags js -->
<script type="text/javascript" src="{{ asset('packages/adminty/bower_components/bootstrap-tagsinput/js/bootstrap-tagsinput.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.10.4/typeahead.bundle.min.js"></script>

<!-- Max-length js -->
<script type="text/javascript" src="{{ asset('packages/adminty/bower_components/bootstrap-maxlength/js/bootstrap-maxlength.js') }}"></script>

<!-- i18next.min.js -->
<script type="text/javascript" src="{{ asset('packages/adminty/bower_components/i18next/js/i18next.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('packages/adminty/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('packages/adminty/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('packages/adminty/bower_components/jquery-i18next/js/jquery-i18next.min.js') }}"></script>

<!-- Font Awesome -->
<script defer src="https://use.fontawesome.com/releases/v5.8.2/js/all.js" integrity="sha384-DJ25uNYET2XCl5ZF++U8eNxPWqcKohUUBUpKGlNLMchM7q4Wjg2CUpjHLaL8yYPH" crossorigin="anonymous"></script>

<!-- Custom js -->
<script type="text/javascript" src="{{ asset('packages/adminty/assets/pages/advance-elements/swithces.js') }}"></script>
<script src="{{ asset('packages/adminty/assets/js/pcoded.min.js') }}"></script>
<script src="{{ asset('packages/adminty/assets/js/vartical-layout.min.js') }}"></script>
<script src="{{ asset('packages/adminty/assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('packages/adminty/assets/js/script.js') }}"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-23581568-13');
</script>

<script src="{{ asset('js/backend.js') }}"></script>

@stack('after-scripts')

</body>

</html>
