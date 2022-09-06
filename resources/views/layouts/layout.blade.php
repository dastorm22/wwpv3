<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('description')">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} | @yield('title')</title>

    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" >

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ mix('css/bundle.css') }}">

    @stack('styles')

    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <script src="{{ asset('js/modernizr.min.js') }}"></script>

    <style>
        .estado1 {color : #32a84e !important; }
        .estado2 {color : #a83232 !important; }
      </style>
</head>

<body class="fixed-left">

<!-- Begin page -->
<div id="wrapper" class="enlarged forced">

    @include('layouts.partials.header')

    @include('layouts.partials.left-sidebar')

    <!-- ========== Content Start ========== -->

    @yield('content')

    <!-- ========== Content End ========== -->

    @include('layouts.partials.right-sidebar')

</div>
<!-- END wrapper -->

@stack('templates')

<script src="{{ mix('js/bundle.js') }}"></script>

@stack('scripts')

</body>
</html>