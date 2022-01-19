<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="robots" content="noindex">
    <title>Home | Training </title>
    <meta property="og:title" content="Home | Training ">

    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="google-site-verification" content="">
    <meta name="msvalidate.01" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="google-site-verification" content="">
    <meta name="msvalidate.01" content="">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/frontend//styles.css')}}" media="screen">
    <link rel="stylesheet" href="{{asset('assets/css/forms.css')}}">
</head>


<body class="template-educate layout-home body-logged_out has_banner has_banner_search has_mobile_footer_menu">
<div class="wrapper">
    @include('frontend.layouts.header')

    <div class="content">
        @yield('content')
    </div>

    @include('frontend.layouts.footer')
</div>

<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap-3.3.5.min.js')}}"></script>

</body>
</html>
