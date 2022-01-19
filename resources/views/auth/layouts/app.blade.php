<!DOCTYPE html>
<html
    class=" js flexbox canvas canvastext webgl no-touch geolocation postmessage websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers no-applicationcache svg inlinesvg smil svgclippaths"
    lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>SAuth :: Login</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS concatenated and minified
    ====================================================================== -->

    @yield('before-styles')
    <link rel="stylesheet" href="{{asset('assets/css/cms.compiled.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/forms.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/stylish.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/elegant_icons.css')}}">

    <link rel="stylesheet" href="{{asset('assets/css/validation.css')}}" media="screen">

    <link rel="stylesheet" href="{{asset('assets/css/login-signup.css')}}">

    <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">

    <link rel="stylesheet" href="{{asset('assets/css/project.css')}}">

    <link rel="stylesheet" href="{{asset('assets/css/intlTelInput.min.css')}}">
@yield('after-styles')
<!-- end CSS -->

</head>


<body class="layout-login theme-ccdemo">

<!-- Container -->
<div class="container-fluid">
    <div class="login-form-container login-form">
        <div class="modal show">
            <div class="modal-dialog">
                <div class="modal-content login">
                    <div class="modal-header">
                        <img class="client-logo" src="{{asset('assets/images/sauth-m-logo.png')}}" alt="">

                        <ul class="nav nav-tabs" id="login-form-tabs">
                            <li class="{{ Route::currentRouteName() == 'user.signup'?'active':'' }}"><a href="{{route('user.signup')}}" >Sign up</a></li>
                            <li class="{{ Route::currentRouteName() == 'user.login'?'active':''}}"><a href="{{route('user.login')}}">Log in</a></li>
                        </ul>
                    </div>

                    @include('auth.layouts.partials.messages')
                    <div class="tab-content">
                        @yield('content')

                        <div class="modal-footer">
                            <a href="{{route('user.login')}}">
                                Go Back &nbsp; <span class="fa fa-angle-right icon-angle-right"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="auto-logout-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Inactive for too long</h4>
                    </div>
                    <div class="modal-body">
                        <p>For your protection, we have logged you out as you have been inactive. You need to login
                            again to continue</p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal">Log in</button>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- End Container -->


    <!-- This is the only JS allowed in the head. All other JS files in the footer
    ====================================================================== -->
    <script src="{{asset('assets/js/modernizr-2.0.6.min.js')}}"></script>
    <!-- Load jQuery from Google or fall back to local copy -->
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <!-- end header JS -->
    <!-- Begin Footer JS section
    ====================================================================== -->

    <script src="{{asset('assets/js/intlTelInput.js')}}"></script>
    <script src="{{asset('assets/js/smartphone.js')}}"></script>


    <!-- End JS section -->

    <!-- Bootstrap style JS script-->
    <script src="{{asset('assets/js/bootstrap-3.3.5.min.js')}}"></script>
    <script src="{{asset('assets/js/bootbox.js')}}"></script>
    <script src="{{asset('assets/js/forms.js')}}"></script>

    <!-- Scripts concatenated and minified via ant build script-->
    <script src="{{asset('assets/js/jquery.validationEngine2.js')}}"></script>
    <script src="{{asset('assets/js/jquery.validationEngine2-en.js')}}"></script>
    <script type="text/javascript" async="" src="{{asset('assets/js/recaptcha__en.js')}}" crossorigin="anonymous"
            integrity="sha384-HTq9bAnQeRQMZWaz4oh4hzQ7uLhEPBDMd6NizGeUQEDJ09mI0WU9lRcdix2okyzP"></script>
    <script src="{{asset('assets/js/scripts.js')}}"></script>
    <!-- end scripts-->

</div>
<div style="display: block; position: fixed; inset: 0px; text-align: center; visibility: hidden; z-index: 9999;">
    <div class="ajax_loader_icon"
         style="position:absolute;top:0;left:0;right:0;bottom:0;background-color:#000;opacity:0.2;filter:alpha(opacity=20);z-index:1;"></div>
    <div class="ajax_loader_icon_inner"
         style="position:absolute;top:50%;left:50%;z-index:2;width: 32px;height: 32px;margin: 0 auto;background-image: {{asset('assets/images/ajax-loader.gif')}}">

    </div>
</div>
</body>
</html>
