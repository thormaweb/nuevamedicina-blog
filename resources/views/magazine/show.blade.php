@extends('layouts.master')

@section('meta_title')Revista {{ $magazine->name }} @endsection
@section('meta_description')[Revista Modo de Vida] - {{ $magazine->getShortDescription() }} @endsection
@section('meta_keywords'){{ $magazine->name }}, {{ $magazine->keywords }}, revista modo de vida @endsection

@section('extra_tags')
    <link rel="stylesheet" type="text/css" href="/css/flipbook.style.css">
    <meta itemprop="image" content="https://www.mododevida.com/files/revista/{{ $magazine->thumbnail }}">
    <meta property="fb:app_id" content="755333887819406"/>
    <meta property="og:locale" content="es_LA"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="Revista Modo de Vida {{ $magazine->name }}"/>
    <meta property="og:description" content="{{ $magazine->getShortDescription() }}"/>
    <meta property="og:site_name" content="www.mododevida.com"/>
    <meta property="og:url" content="{{ Request::url() }}"/>
    <meta property="og:image" content="https://www.mododevida.com/files/revista/{{ $magazine->thumbnail }}"/>
    <meta name="twitter:card" content="summary">
    <meta name="twitter:image" content="https://www.mododevida.com/files/revista/{{ $magazine->thumbnail }}">
    <meta name="twitter:domain" content="www.mododevida.com">
    <meta name="twitter:site" content="@mododevidapr">
    <meta name="twitter:creator" content="@mododevidapr">
    <meta name="twitter:url" content="{{ Request::url() }}">
    <meta name="twitter:title" content="Revista Modo de Vida {{ $magazine->name }}">
    <meta name="twitter:description" content="{{ $magazine->getShortDescription() }}">
@endsection

@push('scripts')
@if(!$magazine->issuu_active)
<script src="/js/flipbook.min.js"></script>

<script type="text/javascript">

    $(document).ready(function () {
        $(".flepbook").flipBook({
            pages:[
                @foreach($magazine->pages()->ordered()->get() as $page)
                {src:"/files/revista/{{$page->src}}", title:"{{$page->title}}"},
                @endforeach
            ],
            {{--pdfUrl:"/files/revista/{{ $magazine->pdf }}",--}}
            lightBox:true,
            zoomLevels: [.9, 1, 1.2, 1.5, 1.8, 2, 2.5, 3, 3.5, 5],
            btnPrint: {enabled: false},
            btnThumbs: {enabled: false},
            btnDownloadPages: {enabled: false}
        });

    })
</script>
@endif
@endpush

@section('content')
    <!-- Heading -->
    <section id="heading">
        <div class="container-fluid">

            <ul class="breadcrumbs">
                <li><a href="/">MDV</a></li>
                <li><a href="/revista">Revista</a></li>
                <li class="active">{{ $magazine->name }}</li>
            </ul>

            <div class="section-title">
                <h1>Revista {{ $magazine->name }}</h1>
            </div>

            @include('_social_share')
        </div>
    </section>
    <!-- /Heading -->

    <!-- Page -->
    <section id="page">
        <div class="container">
            <div class="row">
                @if(!$magazine->issuu_active)
                <div class="col-md-7 col-sm-7">
                    <div class="block">
                        <div class="photo">
                            <a class="flepbook">
                                <img src="/files/revista/{{ $magazine->thumbnail }}" alt="{{ $magazine->name }}"/>
                            </a>
                        </div>
                        <div class="title">
                            <h2><a class="flepbook">{{ $magazine->name }}</a></h2>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-4 col-md-offset-1">

                    <div class="text">
                        <br>
                        <button type="button" class="flepbook frm-submit">&nbsp&nbsp Leer ahora! &nbsp&nbsp</button>
                        <h4>Edición: {{ $magazine->name }}</h4>
                        {!! $magazine->description !!}
                    </div>
                    <br>

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
                @else
                <div class="col-sm-12">
                    {!! $magazine->issuu_script !!}

					<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
					<!-- Bloque adaptable -->
					<ins class="adsbygoogle"
						 style="display:block"
						 data-ad-client="ca-pub-9769143677327615"
						 data-ad-slot="1630936480"
						 data-ad-format="auto"
						 data-full-width-responsive="true"></ins>
					<script>
					(adsbygoogle = window.adsbygoogle || []).push({});
					</script>
				</div>
                @endif
            </div>
        </div>
    </section>
    <!-- /Page -->
@endsection
