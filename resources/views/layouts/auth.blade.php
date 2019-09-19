<!DOCTYPE html>
<!--[if IE 9]>         <html class="no-js lt-ie10" lang="es"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="es"> <!--<![endif]-->
<head>
    <meta charset="utf-8">

    <title>Modo de Vida | Panel Administrador</title>

    <meta name="description" content="Modo de Vida | Panel Administrador">
    <meta name="author" content="mododevida">
    <meta name="robots" content="noindex, nofollow">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Stylesheets -->
    <!-- Bootstrap is included in its original form, unaltered -->
    <link rel="stylesheet" href="/back/css/bootstrap.min.css">

    <!-- Related styles of various icon packs and plugins -->
    <link rel="stylesheet" href="/back/css/plugins.css">

    <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
    <link rel="stylesheet" href="/back/css/main.css">

    <!-- Include a specific file here from css/themes/ folder to alter the default theme of the template -->

    <!-- The themes stylesheet of this template (for using specific theme color in individual elements - must included last) -->
    <link rel="stylesheet" href="/back/css/themes.css">
    <!-- END Stylesheets -->

    <!-- Modernizr (browser feature detection library) -->
    <script src="/back/js/vendor/modernizr.min.js"></script>
</head>
<body>
<!-- Login Full Background -->
<!-- For best results use an image with a resolution of 1280x1280 pixels (prefer a blurred image for smaller file size) -->
{{--<img src="/back/img/placeholders/backgrounds/login_full_bg.jpg" alt="MDV    " class="full-bg animation-pulseSlow">--}}
<!-- END Login Full Background -->

<!-- Login Container -->
<div id="login-container" class="animation-fadeIn">
    <div class="login-box">
        <!-- Login Title -->
        <div class="login-title text-center">
            <h1><img src="/images/logos/logomdv.jpg" width="180px"></h1>
        </div>
        <!-- END Login Title -->

        <!-- Login Block -->
        <div class="block push-bit">
            @yield('content')
        </div>
    </div>
    <!-- END Login Block -->
</div>
<!-- END Login Container -->


<!-- jQuery, Bootstrap.js, jQuery plugins and Custom JS code -->
<script src="/back/js/vendor/jquery.min.js"></script>
<script src="/back/js/vendor/bootstrap.min.js"></script>
<script src="/back/js/plugins.js"></script>
<script src="/back/js/app.js"></script>

<!-- Load and execute javascript code used only in this page -->
<script src="/back/js/pages/login.js"></script>
<script>$(function(){ Login.init(); });</script>
</body>
</html>