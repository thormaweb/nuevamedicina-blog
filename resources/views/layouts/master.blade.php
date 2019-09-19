<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Language" content="es" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="MobileOptimized" content="width" />
    <meta name="HandheldFriendly" content="true" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <title>@yield('meta_title')| Modo de Vida</title>
    <meta name="description" content="@yield('meta_description')" />
    <meta name="keywords" content="@yield('meta_keywords')" />

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-NNTXCW');
    </script>
    <!-- End Google Tag Manager -->

    <!-- Bootstrap -->
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- styles -->
    <link rel="stylesheet" href="/js/slick/slick.css">
    <link rel="stylesheet" href="/js/fancybox/jquery.fancybox.css">
    <link rel="stylesheet" href="/scss/bee-ui.css"/>
    <link rel="stylesheet" href="/scss/style.css"/>

    <!-- favicon -->
    <link rel="shortcut icon" href="/images/logos/favicon.png"/>
    @include('feed::links')


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    @yield('extra_tags')

</head>

<body class="init">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NNTXCW" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<!-- Preloader -->
<div id="preload"></div>
<!-- /Preloader -->

<!-- Header -->
<header id="head">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 top-header">
                <div class="col-sm-4 search-box">
                    <form id="search-form" action="/buscar" method="get">
                        <div class="search-container">
                            <input type="hidden" name="email">
                            <input type="text" name="query" class="search-input" placeholder="BÚSQUEDA">
                            <span class="search-submit"><i class="fa fa-search"></i></span>
                        </div>
                    </form>
                </div>
                <div class="col-sm-4">
                    <div id="logo">
                        <a href="/">
                            <img src="/images/logos/logomdv.jpg" alt="Modo de Vida"/>
                        </a>
                    </div>
                </div>
                <div class="col-sm-4 social-top">
                    <div id="social">
                        <a href="http://www.facebook.com/mododevidapr" target="_blank"><i class="fa fa-facebook-square"></i> </a>
                        <a href="https://twitter.com/mododevidapr" target="_blank"><i class="fa fa-twitter-square"></i> </a>
                        <a href="http://www.pinterest.com/mododevida" target="_blank"><i class="fa fa-pinterest-square"></i> </a>
                        <a href="https://www.instagram.com/mododevidapr/" target="_blank"><i class="fa fa-instagram"></i> </a>
                    </div>
                </div>
            </div>
            <div class="col-md-12" style="margin-top:25px;">
                <a href="/tienda">
                    <img src="/images/window_shoping.png" alt="Modo de Vida Shoping"/>
                </a>
            </div>
            <div class="col-md-12">

                <!-- Mobile Toggle Menu -->
                <a href="#nav1" class="tgl-menu">menu</a>
                <!-- /Mobile Toggle Menu -->
                <!-- Main Nav -->
                <nav id="nav1" class="menu">
                    <ul class="main_nav">
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="/tienda/categoria/sala">Sala</a>
                            <ul class="dropdown-menu" id="menu1">
                                <li><a href="/tienda/categoria/sala/sofas">Sofás</a></li>
                                <li><a href="/tienda/categoria/sala/sillas-y-butacas-sala">Sillas y Butacas</a></li>
                                <li><a href="/tienda/categoria/sala/mesas-sala">Mesas (Sala)</a></li>
                                <li><a href="/tienda/categoria/sala/auxiliares-sala">Auxiliares (Sala)</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="/tienda/categoria/comedor">Comedor</a>
                            <ul class="dropdown-menu" id="menu2">
                                <li><a href="/tienda/categoria/comedor/mesas-comedor">Mesas (Comedor)</a></li>
                                <li><a href="/tienda/categoria/comedor/sillas-comedor">Sillas (Comedor)</a></li>
                                <li><a href="/tienda/categoria/comedor/muebles-comedor">Muebles (Comedor)</a></li>
                                <li><a href="/tienda/categoria/comedor/auxiliares-comedor">Auxiliares (Comedor)</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="/tienda/categoria/dormitorios">Dormitorios</a>
                            <ul class="dropdown-menu" id="menu3">
                                <li><a href="/tienda/categoria/dormitorios/camas">Camas</a></li>
                                <li><a href="/tienda/categoria/dormitorios/mesas-de-noche">Mesas de noche</a></li>
                                <li><a href="/tienda/categoria/dormitorios/gaveteros">Gaveteros</a></li>
                                <li><a href="/tienda/categoria/dormitorios/muebles-dormitorio">Muebles (Dormitorio)</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="/tienda/categoria/iluminacion">Iluminación</a>
                            <ul class="dropdown-menu" id="menu4">
                                <li><a href="/tienda/categoria/iluminacion/colgantes-iluminacion">Colgantes (Iluminación)</a></li>
                                <li><a href="/tienda/categoria/iluminacion/lamparas-de-piso">Lamparas de piso</a></li>
                                <li><a href="/tienda/categoria/iluminacion/lamparas-de-mesa">Lámparas de mesa</a></li>
                                <li><a href="/tienda/categoria/iluminacion/lamparas-colgantes">Lámparas colgantes</a></li>
                                <li><a href="/tienda/categoria/iluminacion/otros-iluminacion">Otros (Iluminación)</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="/tienda/categoria/alfombras">Alfombras</a>
                        </li>
                        <li>
                            <a href="/tienda/categoria/telas">Telas</a>
                        </li>
                        <li>
                            <a href="/tienda/categoria/empapelados">Empapelados</a>
                        </li>
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="/tienda/categoria/accesorios">Accesorios</a>
                            <ul class="dropdown-menu" id="menu5">
                                <li><a href="/tienda/categoria/accesorios/abanicos">Abanicos</a></li>
                                <li><a href="/tienda/categoria/accesorios/accesorios-de-bano">Accesorios de Baño</a></li>
                                <li><a href="/tienda/categoria/accesorios/accesorios-de-cocina">Accesorios de Cocina</a></li>
                                <li><a href="/tienda/categoria/accesorios/adornos">Adornos</a></li>
                                <li><a href="/tienda/categoria/accesorios/arte">Arte</a></li>
                                <li><a href="/tienda/categoria/accesorios/cojines">Cojines</a></li>
                                <li><a href="/tienda/categoria/accesorios/cortinas-y-toldos">Cortinas y Toldos</a></li>
                                <li><a href="/tienda/categoria/accesorios/espejos">Espejos</a></li>
                                <li><a href="/tienda/categoria/accesorios/fragancias">Fragancias</a></li>
                                <li><a href="/tienda/categoria/accesorios/ropa-de-cama">Ropa de cama</a></li>
                                <li><a href="/tienda/categoria/accesorios/armarios-consolas-y-libreros">Armarios, consolas y libreros</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="/tienda/categoria/losas">Losas</a>
                        </li>
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="/tienda/categoria/cocinas">Cocinas</a>
                            <ul class="dropdown-menu" id="menu6">
                                <li><a href="/tienda/categoria/cocinas/gabinetes-cocina">Gabinetes (Cocina)</a></li>
                                <li><a href="/tienda/categoria/cocinas/griferia-cocina">Grifería (Cocina)</a></li>
                                <li><a href="/tienda/categoria/cocinas/equipo-cocina">Equipo (Cocina)</a></li>
                                <li><a href="/tienda/categoria/cocinas/vajillas-y-cristaleria">Vajillas y cristalería</a></li>
                                <li><a href="/tienda/categoria/cocinas/superficies">Superficies</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="/tienda/categoria/banos">Baños</a>
                            <ul class="dropdown-menu" id="menu7">
                                <li><a href="/tienda/categoria/banos/gabinetes-bano">Muebles Espejos Lavabos</a></li>
                                <li><a href="/tienda/categoria/banos/baneras-y-spa">Bañeras y Spa</a></li>
                                <li><a href="/tienda/categoria/banos/griferia-bano">Grifería (Baño)</a></li>
                                <li><a href="/tienda/categoria/banos/puertas-de-cristal">Puertas de cristal</a></li>
                                <li><a href="/tienda/categoria/banos/sanitarios">Sanitarios</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle">Otros</a>
                            <ul class="dropdown-menu" id="menu8">
                                <li><a href="/tienda/categoria/otros/puertas-y-ventanas">Puertas  y Ventanas</a></li>
                                <li><a href="/tienda/categoria/otros/eco-inteli-safe-home">ECO-INTELI-SAFE-HOME</a></li>
                                <li><a href="/tienda/categoria/otros/joyeria">Joyería</a></li>
                                <li><a href="/tienda/categoria/otros/autos">Autos</a></li>
                                <li><a href="/tienda/categoria/otros/bienes-raices">Bienes raíces</a></li>
                                <li><a href="/tienda/categoria/otros/salud">Salud</a></li>
                                <li><a href="/tienda/categoria/otros/mascotas">Mascotas</a></li>
                            </ul>
                        </li>
                        <li><a href="/articulos">Noticias</a></li>
                    </ul>
                </nav>
                <!-- /Main Nav -->

            </div>
        </div>
    </div>
</header>
<!-- /Header -->
@yield('content')
    <hr style="border: solid #e6e6e6 1px;max-width: 1180px;margin: 4rem auto;">
    <div class="divider"></div>
<!-- Footer -->
<footer id="foot">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-sm-8">

                <div class="links" style="border: 0">
                    <a href="/politica-de-privacidad">Política de Privacidad</a>&nbsp;|
                    <a href="/quienes-somos">Quiénes Somos</a>&nbsp;|
                    <a href="/suscripciones#!/REVISTA-IMPRESA/p/17101930/category=6366080">Suscripciones</a>&nbsp;|
                    <a href="/contacto">Contáctanos</a>
                </div>

                <div class="credits">
                    Copyright © 2012 - {{ date('Y') }} | Modo de Vida
                </div>

            </div>
            <div class="col-md-4 col-sm-4">

                <div class="newsletter">
                    <h3>Newsletter</h3>
                    <form action="//mododevida.us15.list-manage.com/subscribe/post?u=0b6a073c0cb9b2a918f47eedb&amp;id=bbad6997a2" method="post">
                        <input type="email" class="frm-text" name="EMAIL" placeholder="email" />
                        <input type="submit" class="frm-submit" value="ENVIAR" />
                    </form>
                </div>

                <div class="social">
                    Síguenos:
                    <a href="http://www.facebook.com/mododevidapr" target="_blank"><i class="fa fa-facebook-square"></i> facebook</a>
                    <a href="https://twitter.com/mododevidapr" target="_blank"><i class="fa fa-twitter-square"></i> twitter</a>
                    <a href="http://www.pinterest.com/mododevida" target="_blank"><i class="fa fa-pinterest-square"></i> pinterest</a>
                </div>

            </div>
        </div>
    </div>
</footer>
<!-- Footer -->


<!-- Newsletter Popup -->
<div id="mpopupBox" class="mpopup">
    <!-- mPopup content -->
    <div class="mpopup-content">
        <div class="mpopup-head">
            <span class="close">×</span>
            <img class="logo" src="/images/logos/logomdv.jpg" alt="Modo de Vida"/>
            <h2>Recibe gratis nuestras actualizaciones por correo</h2>
        </div>
        <div class="mpopup-main">
            <div class="newsletter">
                <h3>Ingresa tu correo aquí para recibir novedades de nuevos productos, galerias y articulos</h3>
                <form action="//mododevida.us15.list-manage.com/subscribe/post?u=0b6a073c0cb9b2a918f47eedb&amp;id=bbad6997a2" method="post">
                    <input type="email" class="frm-text" name="EMAIL" placeholder="ingresa tu correo" />
                    <input type="submit" class="frm-submit" value="SUSCRIBIRME" />
                </form>
            </div>
        </div>
        <div class="mpopup-foot">
            <p>A nosotros tampoco nos gusta el spam, prometemos solo enviarte información interesante.</p>
        </div>
    </div>
</div>

<!--[if lt IE 9]>
<script src="/js/jquery/jquery-1.12.1.min.js"></script>
<![endif]-->
<!--[if gte IE 9]><!-->
<script src="/js/jquery/jquery-2.2.1.min.js"></script>
<!--<![endif]-->
<script src="/js/jquery/jquery-1.12.1.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/bootstrap/js/bootstrap.min.js"></script>

<!-- Scripts files -->
<script src="/js/fancybox/jquery.fancybox.js"></script>
<script src="/js/jquery.waitforimages.js"></script>
<script src="/js/slick/slick.min.js"></script>
<script src="/js/masonry.pkgd.js"></script>

<!-- General JS Scripts Manager -->
<script src="/js/jquery.cookie.js"></script>
<script src="/js/general.js"></script>
@stack('scripts')

<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "WebSite",
  "url": "https://www.mododevida.com/",
  "potentialAction": {
    "@type": "SearchAction",
    "target": "https://www.mododevida.com/buscar?query={query}",
    "query-input": "required name=query"
  }
}
</script>
<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "WebSite",
  "name": "Modo de Vida",
  "alternateName": "DISEÑO | DECORACIÓN | ARQUITECTURA | Modo de Vida",
  "url": "https://www.mododevida.com"
}
</script>
<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "Organization",
  "name": "Modo de Vida",
  "url": "https://www.mododevida.com",
  "sameAs": [
    "http://www.facebook.com/mododevidapr",
    "https://twitter.com/mododevidapr",
    "http://www.pinterest.com/mododevida",
    "https://www.youtube.com/channel/UCGiNj8Yp7R_lsNWyfsLe6TQ"
  ]
}
</script>

</body>
</html>