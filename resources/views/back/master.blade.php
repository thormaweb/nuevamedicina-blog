<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if IE 9]>         <html class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">

    <title>
        @yield('title', 'Modo de Vida')
    </title>

    <meta name="author" content="Modo de Vida">
    <meta name="robots" content="noindex, nofollow">

    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">

    <link rel="shortcut icon" href="/images/logos/favicon.png">

    <link rel="stylesheet" href="/back/css/bootstrap.min.css">

    <link rel="stylesheet" href="/back/css/plugins.css">

    <link rel="stylesheet" href="/back/css/main.css">

    <link rel="stylesheet" href="/back/css/custom.css">

    @stack('css')

</head>
<body>

<div id="page-wrapper">

    <div class="preloader themed-background">
        <h1 class="push-top-bottom text-light text-center">Modo de <strong>Vida</strong></h1>

    </div>

    <div id="page-container" class="sidebar-visible-lg sidebar-no-animations">

        <div id="sidebar">
            <div id="sidebar-alt-scroll">
                <div class="sidebar-content">

                    <a href="{{ url('/admin') }}" class="sidebar-brand">
                        <img src="/images/logos/logomdv.jpg" alt="Modo de Vida" width="100%">
                    </a>

                    <ul class="sidebar-nav">

                        <li class="sidebar-header">
                            <span class="sidebar-header-title">Contenido</span>
                        </li>
                        @permission('crudProducts')
                        <li>
                            <a href="#" class="sidebar-nav-menu">
                                <i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i>
                                <i class="gi gi-cart_in sidebar-nav-icon"></i>
                                <span class="sidebar-nav-mini-hide">Tienda</span>
                            </a>
                            <ul>
                                <li>
                                    <a href="{{ route('productBack') }}">Productos</a>
                                </li>
                                @permission('crudVendors')
                                <li>
                                    <a href="{{ route('vendorBack') }}">Proveedores</a>
                                </li>
                                @endpermission
                            </ul>
                        </li>
                        @endpermission

                        @permission('crudArticles')
                        <li>
                            <a href="{{ route('articleBack') }}"><i class="gi gi-edit sidebar-nav-icon"></i> Articulos</a>
                        </li>
                        @endpermission

                        @permission('crudArticles')
                        <li>
                            <a href="{{ route('magazineBack') }}"><i class="gi gi-book_open sidebar-nav-icon"></i> Revista</a>
                        </li>
                        @endpermission

                        @permission('crudSliders')
                        <li>
                            <a href="{{ route('slideBack') }}"><i class="gi gi-picture sidebar-nav-icon"></i> Home Slider</a>
                        </li>
                        @endpermission

                        @permission('crudUsers')
                        <li class="sidebar-header">
                            <span class="sidebar-header-title">Sistema</span>
                        </li>
                        <li>
                            <a href="{{ route('userBack') }}"><i class="gi gi-user sidebar-nav-icon"></i> Usuarios</a>
                        </li>
                        <li>
                            <a href="{{ route('report') }}"><i class="gi gi-charts sidebar-nav-icon"></i> Reporte</a>
                        </li>
                        @endpermission


                    </ul>

                </div>
            </div>
        </div>

        <div id="main-container">
            <header class="navbar navbar-default">
                <ul class="nav navbar-nav-custom">
                    <!-- Main Sidebar Toggle Button -->
                    <li>
                        <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar');this.blur();">
                            <i class="fa fa-bars fa-fw"></i>
                        </a>
                    </li>
                    <!-- END Main Sidebar Toggle Button -->

                    <!-- Template Options -->
                    <!-- Change Options functionality can be found in js/app.js - templateOptions() -->
                    <li class="dropdown">
                        <a href="/" target="_blank">
                            <i class="fa fa-external-link fa-fw"></i>
                        </a>
                    </li>
                    <!-- END Template Options -->
                </ul>

                <ul class="nav navbar-nav-custom pull-right">

                    <li class="dropdown">
                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                            {{ Auth::user()->name }} <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-custom dropdown-menu-right">
                            <li>
                                <a href="{{ url('salir') }}"><i class="fa fa-ban fa-fw pull-right"></i> Salir</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </header>

            <div id="page-content">

                @yield('content-header')

                @yield('content')

            </div>

            <footer class="clearfix">
                <div class="pull-left">
                    {{ date("Y") }} &copy; <a href="{{ url('') }}" target="_blank">Modo de Vida</a>
                </div>
            </footer>
        </div>
    </div>
</div>

<a href="#" id="to-top"><i class="fa fa-angle-double-up"></i></a>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

{{--<script src="{{ url('js/jquery-1.12.1.min.js') }}"></script>--}}
{{--<script src="{{ url('js/bootstrap.min.js') }}"></script>--}}

<script src="{{ url('/back/js/plugins.js') }}"></script>
<script src="{{ url('/back/js/app.js') }}"></script>

@stack('scripts')

</body>
</html>
