@extends('layouts.master')

@section('meta_title'){{ $article->name }} | Artículos @endsection
@section('meta_description'){{ $article->getShortDescription() }} @endsection
@section('meta_keywords'){{ $article->name }}, {{ $article->category->name }}, modo de vida @endsection

@section('extra_tags')
<meta itemprop="image" content="https://www.mododevida.com/photos/{{ $article->featuredImage()->url }}">
<meta property="fb:app_id" content="755333887819406"/>
<meta property="og:locale" content="es_LA"/>
<meta property="og:type" content="article"/>
<meta property="og:title" content="{{ $article->name }}"/>
<meta property="og:description" content="{{ $article->getShortDescription() }}"/>
<meta property="og:site_name" content="www.mododevida.com"/>
<meta property="og:url" content="{{ Request::url() }}"/>
<meta property="og:image" content="https://www.mododevida.com/photos/{{ $article->featuredImage()->url }}"/>
<meta name="twitter:card" content="summary">
<meta name="twitter:image" content="https://www.mododevida.com/photos/{{ $article->featuredImage()->url }}">
<meta name="twitter:domain" content="www.mododevida.com">
<meta name="twitter:site" content="@mododevidapr">
<meta name="twitter:creator" content="@mododevidapr">
<meta name="twitter:url" content="{{ Request::url() }}">
<meta name="twitter:title" content="{{ $article->name }}">
<meta name="twitter:description" content="{{ $article->getShortDescription() }}"> @endsection

@section('content')
    <!-- Heading -->
    <section id="heading">
        <div class="container-fluid">

            <ul class="breadcrumbs">
                <li><a href="/">MDV</a></li>
                <li><a href="{{ route('articles') }}">Articulos</a></li>
                <li><a href="{{ route('articleCategory', $article->category->slug) }}">{{ $article->category->name }}</a></li>
                <li class="active">{{ $article->name }}</li>
            </ul>

            <div class="section-title">
                <h1>{{ $article->name }}</h1>
            </div>

            @include('_social_share')

            <div class="row">
                <div class="col-md-12">
                    <div class="bg"><img src="/photos/{{ $article->featuredImage()->url }}" alt="{{ $article->name }}"/></div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Heading -->

    <!-- Page -->
    <section id="page">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-9">
                    <div class="text m-t-20">
                        {!! $article->text !!}
                    </div>
                    <br><br>
                    <h3>Noticias Relacionadas</h3>
                    <div class="grid-list posts">
                        <ul>

                            @foreach($relatedArticles as $article)
                                <li class="col-md-4 col-sm-6">
                                    <div class="post">
                                        <a href="{{ route('article', [$article->category->slug, $article->slug]) }}">
                                            <div class="photo" style="background-image: url('/photos/{{ $article->featuredImage()->url }}');">
                                            </div>
                                        </a>
                                        <div class="title">
                                            <div class="date"><a>{{ $article->publishedAt() }}</a></div>
                                            <h2><a href="{{ route('article', [$article->category->slug, $article->slug]) }}">{{ $article->name }}</a></h2>
                                            <div class="cat"><a href="{{ route('articleCategory', $article->category->slug) }}">{{ $article->category->name }}</a></div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-sm-3">

                    <!-- category list -->
                    <div class="cat-list m-t-20">
                        <a>Publicado el: <br>{{ $article->publishedAt() }}</a>
                        <ul>
                            <li><a>Categoría:</a></li>
                            <li class="active">
                                <a href="{{ route('articleCategory', $article->category->slug) }}">
                                    {{ $article->category->name }}
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- /category list -->
                    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <!-- Bloque adaptable -->
                    <ins class="adsbygoogle"
                         style="display:block"
                         data-ad-client="ca-pub-9769143677327615"
                         data-ad-slot="1630936480"
                         data-ad-format="auto"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>

                </div>
            </div>
        </div>
    </section>
    <!-- /Page -->
@endsection