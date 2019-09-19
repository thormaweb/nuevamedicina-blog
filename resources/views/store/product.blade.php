@extends('layouts.master')

@section('meta_title'){{ $product->name }} | Tienda @endsection
@section('meta_description')[{{ $product->name }} | {{ $product->category->name }}] - {{ $product->getShortDescription() }} @endsection
@section('meta_keywords'){{ $product->name }}, {{ $product->category->name }}, {{ $product->vendor->name }},
@foreach($product->rooms as $room){{ $room->name }}, @endforeach
@foreach($product->colors as $color){{ $color->name }}, @endforeach modo de vida @endsection

@section('extra_tags')
    @if($product->images->count() >= 1)
    <meta itemprop="image" content="https://www.mododevida.com/photos/{{ $product->featuredImage()->url }}">
    <meta property="og:image" content="https://www.mododevida.com/photos/{{ $product->featuredImage()->url }}"/>
    <meta name="twitter:image" content="https://www.mododevida.com/photos/{{ $product->featuredImage()->url }}">
    @endif
    <meta property="fb:app_id" content="755333887819406"/>
    <meta property="og:locale" content="es_LA"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="{{ $product->name }} - {{ $product->vendor->name }}"/>
    <meta property="og:description" content="{{ $product->getShortDescription() }}"/>
    <meta property="og:site_name" content="www.mododevida.com"/>
    <meta property="og:url" content="{{ Request::url() }}"/>
    <meta name="twitter:card" content="summary">
    <meta name="twitter:domain" content="www.mododevida.com">
    <meta name="twitter:site" content="@mododevidapr">
    <meta name="twitter:creator" content="@mododevidapr">
    <meta name="twitter:url" content="{{ Request::url() }}">
    <meta name="twitter:title" content="{{ $product->name }} - {{ $product->vendor->name }}">
    <meta name="twitter:description" content="{{ $product->getShortDescription() }}">
@endsection

@section('content')
    <div itemscope itemtype="http://schema.org/Product">
        <!-- Heading -->
        <section id="heading">
            <div class="container-fluid">

                <ul class="breadcrumbs">
                    <li><a href="/">MDV</a></li>
                    <li><a href="/tienda/">Tienda</a></li>
                    <li class="active"><a href="/tienda/{{ $product->vendor->slug }}">{{ $product->vendor->name }}</a></li>
                </ul>

                <div class="section-title">
                    <h2  itemprop="name">{{ $product->name }}</h2>
                </div>

                @include('_social_share')

                <div class="row">
                    <div class="col-md-12">

                        <!-- Prod Carousel -->
                        <div class="carousel slider">
                            @if($product->images->count() >= 1)
                                @foreach($product->imagesOrdered() as $image)
                                    <div class="c-wrap">
                                        <img src="/photos/{{ $image->url }}" alt="{{ $product->name }} - {{ $product->vendor->name }}"/>
                                        <link itemprop="image" href="/photos/{{ $image->url }}" />
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <!-- /Prod Carousel -->

                    </div>
                </div>
            </div>
        </section>
        <!-- Heading -->

        <!-- Page -->
        <section id="page">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="text" itemprop="description">
                            {{ $product->description }}
                        </div>
                        <div class="details">
                            <ul itemprop="brand" itemscope itemtype="http://schema.org/Organization">
                                <li itemprop="name"><strong>Tienda</strong> {{ $product->vendor->name }}</li>
                                <li><strong>Website</strong> <a href="http://{{ $product->vendor->website }}" rel="nofollow" target="_blank"> {{ $product->vendor->website }}</a></li>
                                <li><strong>Teléfono</strong> {{ $product->vendor->phone }}</li>
                                <li><strong>Email</strong> {{ $product->vendor->email }}</li>
                            </ul>
                        </div>
                        {{--cuando agregue el rating sacar las meta etiquetas de schema.org de esta pagina: http://getschema.org/index.php/Product--}}
                        {{--<div class="moreinfo">--}}
                        {{--<h3>Quieres calificar este producto? <a href="#frm-prod" id="tgl-form">Tu opinion nos interesa</a></h3>--}}
                        {{--<form id="frm-prod" method="post">--}}
                        {{--<p>Hola,<br/>--}}
                        {{--Mi nombre es <input type="text" class="frm-text" placeholder="tu nombre" required/>,--}}
                        {{--mi email es <input type="email" class="frm-text" placeholder="tu email" required/>--}}
                        {{--y le doy a este producto:</p>--}}
                        {{--<label class="radio-inline"><input type="radio" name="optradio">1 Estrella</label>--}}
                        {{--<label class="radio-inline"><input type="radio" name="optradio">2 Estrellas</label>--}}
                        {{--<label class="radio-inline"><input type="radio" name="optradio">3 Estrellas</label><label class="radio-inline"><input type="radio" name="optradio">4 Estrellas</label>--}}
                        {{--<label class="radio-inline"><input type="radio" name="optradio">5 Estrellas</label>--}}
                        {{--<br><br><input type="submit" class="frm-submit" value="Calificar"/>--}}
                        {{--</form>--}}
                        {{--</div>--}}
                    </div>
                </div>
            </div>
        </section>
        <!-- /Page -->
    </div>
@endsection
