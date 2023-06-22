<!DOCTYPE html>
<html lang="en">

<head>
    <title>EUCOMB - @yield('title')</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Datta Able Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
    <meta name="keywords" content="admin templates, bootstrap admin templates, bootstrap 4, dashboard, dashboard templets, sass admin templets, html admin templates, responsive, bootstrap admin templates free download,premium bootstrap admin templates, datta able, datta able bootstrap admin template">
    <meta name="author" content="Codedthemes" />

    <!-- Favicon icon -->
    <link rel="icon" href="{{asset('assets/images/favicon.ico')}}" type="image/x-icon">
    <!-- fontawesome icon -->
    <link rel="stylesheet" href="{{asset('assets/fonts/fontawesome/css/fontawesome-all.min.css')}}">
    <!-- animation css -->
    <link rel="stylesheet" href="{{asset('assets/plugins/animation/css/animate.min.css')}}">
    <!-- prism css -->
    <link rel="stylesheet" href="{{asset('assets/plugins/prism/css/prism.min.css')}}">
    <!-- vendor css -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <!-- <link rel="stylesheet" href="assets/css/layouts/dark.css"> -->
</head>
<body class="layout-8">   

    <!-- [ navigation menu ] start -->
   @include('layouts.main_menu')
    <!-- [ navigation menu ] end -->

    <!-- [ Header ] start -->
   @include('layouts.header_menu')
    <!-- [ Header ] end -->

    
    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-wrapper">
            <div class="pcoded-content">
                <div class="pcoded-inner-content">
                    <!-- [ breadcrumb ] start -->
                    <div class="page-header">
                        <div class="page-block">
                            <div class="row align-items-center">
                                <div class="col-md-12">
                                    <div class="page-header-title">
                                        <h5 class="m-b-10">@yield('apartado')</h5>
                                    </div>
                                    <ul class="breadcrumb">
                                        <!-- <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                                        <li class="breadcrumb-item"><a href="#!">Layout</a></li>--> 
                                        @section('breadcumb')

                                        @show
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- [ breadcrumb ] end -->
                    <div class="main-body">
                        <div class="page-wrapper">
                            <!-- [ Main Content ] start -->
                           @section('contenido')
                           @show
                            <!-- [ Main Content ] end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
    <!-- Required Js -->
    <script src="{{asset('assets/js/vendor-all.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/pcoded.min.js')}}"></script>

    <!-- prism Js -->
    <script src="{{asset('assets/plugins/prism/js/prism.min.js')}}"></script>
    <script>
        // Active Color
        $('.active-color > a').on('click', function() {
            var temp = $(this).attr('data-value');
            $('.active-color > a').removeClass('active');
            $(this).addClass('active');
            if (temp == "active-default") {
                $('.pcoded-navbar').removeClassPrefix('active-');
            } else {
                $('.pcoded-navbar').removeClassPrefix('active-');
                $('.pcoded-navbar').addClass(temp);
            }
        });
        // Caption Hide
        $('#caption-hide').change(function() {
            if ($(this).is(":checked")) {
                $('.pcoded-navbar').addClass('caption-hide');
            } else {
                $('.pcoded-navbar').removeClass('caption-hide');
            }
        });
        // title Color
        $('.title-color > a').on('click', function() {
            var temp = $(this).attr('data-value');
            $('.title-color > a').removeClass('active');
            $(this).addClass('active');
            if (temp == "title-default") {
                $('.pcoded-navbar').removeClassPrefix('title-');
            } else {
                $('.pcoded-navbar').removeClassPrefix('title-');
                $('.pcoded-navbar').addClass(temp);
            }
        });
        // Menu Icon Color
        $('#icon-colored').change(function() {
            if ($(this).is(":checked")) {
                $('.pcoded-navbar').addClass('icon-colored');
            } else {
                $('.pcoded-navbar').removeClass('icon-colored');
            }
        });
        // Box layouts
        $('#box-layouts').change(function() {
            if ($(this).is(":checked")) {
                $('body').addClass('container');
                $('body').addClass('box-layout');
            } else {
                $('body').removeClass('container');
                $('body').removeClass('box-layout');
            }
        });
        // brand Color
        $('.brand-color > a').on('click', function() {
            var temp = $(this).attr('data-value');
            $('.brand-color > a').removeClass('active');
            $(this).addClass('active');
            $('.pcoded-navbar').removeClassPrefix('brand-');
            $('.pcoded-navbar').addClass(temp);
        });
        // Header Color
        $('.header-color > a').on('click', function() {
            var temp = $(this).attr('data-value');
            $('.header-color > a').removeClass('active');
            $(this).addClass('active');
            if (temp == "header-default") {
                $('.pcoded-header').removeClassPrefix('header-');
            } else {
                $('.pcoded-header').removeClassPrefix('header-');
                $('.pcoded-header').addClass(temp);
            }
        });
        // Menu Dropdown icon
        function drpicon(temp) {
            if (temp == "style1") {
                $('.pcoded-navbar').removeClassPrefix('drp-icon-');
            } else {
                $('.pcoded-navbar').removeClassPrefix('drp-icon-');
                $('.pcoded-navbar').addClass('drp-icon-' + temp);
            }
        }
        // Menu subitem icon
        function menuitemicon(temp) {
            if (temp == "style1") {
                $('.pcoded-navbar').removeClassPrefix('menu-item-icon-');
            } else {
                $('.pcoded-navbar').removeClassPrefix('menu-item-icon-');
                $('.pcoded-navbar').addClass('menu-item-icon-' + temp);
            }
        }
        $.fn.removeClassPrefix = function(prefix) {
            this.each(function(i, it) {
                var classes = it.className.split(" ").map(function(item) {
                    return item.indexOf(prefix) === 0 ? "" : item;
                });
                it.className = classes.join(" ");
            });
            return this;
        };
    </script>
</body>
</html>
