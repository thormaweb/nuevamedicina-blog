@extends('layouts.master')

@section('meta_title')DISEÑO | DECORACIÓN | ARQUITECTURA @endsection

@section('content')
    <!-- Slider -->
    <section id="slider">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- Slide-Carousel -->
                    {{--<span class="Pasadas_Ediciones">--}}
                        {{--<a href="http://www.revista.mododevida.com"><img src="/images/pasadas_ediciones.png" alt="Pasadas Ediciones de Modo de Vida"></a>--}}
                    {{--</span>--}}
                    <div class="carousel brands">
                        @inject('slides', 'App\Slide')
                        @foreach($slides->where('slider', 'home')->ordered()->get() as $slide)

                        <div class="c-wrap">
                            <div class="item">
                                <div class="bg">
                                    <img src="/photos/{{ $slide->image }}" alt="{{ $slide->title }}"/>
                                </div>
                                <div class="text white">
                                    <h3>
                                        <a href="{{ $slide->link }}">
                                            <small>{{ $slide->title }}</small>
                                            <span>{{ $slide->description }}</span>
                                        </a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- /Slide-Carousel -->

                </div>
            </div>
        </div>
    </section>
    <!-- /Slider -->

    <!-- Intro -->
    {{-- <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-sm-12">

                    <!-- single block -->
                    <div class="block">
                        <!--<div class="photo">-->
			<div class="">
			<a href="/tienda">
			    <img src="/images/window_shoping.png" alt="Modo de Vida Shoping"/>
			</a>
                        </div>
                    </div>
                    <!-- /single block -->

                </div>
            </div>
        </div>
    </section> --}}
    <div class="divider"></div>
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-sm-4">

                    <!-- single block -->
                    <div class="block">
                        <div class="photo">
                            <a href="/suscripciones#!/REVISTA-IMPRESA/p/17101930/category=6366080">
                                <img src="/images/suscripcion.png" alt="Suscripcion"/>
                            </a>
                        </div>
                        <div class="title">

                        </div>
                    </div>
                    <!-- /single block -->

                </div>
                <div class="col-md-8 col-sm-8">

                    <!-- single block -->
                    <div class="block">
                        <div class="photo">
                            <a href="/revista">
                                <img src="/images/pasadas_ediciones.png" alt="Pasadas Ediciones"/>
                            </a>
                        </div>
                        <div class="title">

                        </div>
                    </div>
                    <!-- /single block -->

                </div>
            </div>
        </div>
    </section>

    <hr style="border: solid #e6e6e6 1px;max-width: 1180px;margin: 4rem auto;">

    <div class="divider"></div>
    <section>
        <div class="container-fluid">
            <div class="row">
                @foreach($articles as $article)
                <div class="col-sm-6" style="padding:2rem">
                    <div class="block">
                            <h2>{{ $article->name }}</h2>
                            <a href="{{ route('article', [$article->category->slug, $article->slug]) }}">
                                <div class="photo_call" style="background-position-x: -100px;background-image: url('/photos/{{ $article->featuredImage()->url }}');">
                                </div>
                            </a>
                            <p style="margin-top: 10px;font-size: 19px;">{!! strip_tags(str_limit($article->text, 230)) !!} 
                                <a href="{{ route('article', [$article->category->slug, $article->slug]) }}" style="color: #929f3f">[...]</a>
                            </p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <hr style="border: solid #e6e6e6 1px;max-width: 1180px;margin: 4rem auto;">
    <div class="divider"></div>
    <section>
        <div class="container-fluid home-ads">
			<div class="row">
                <div class="col-md-3">
                    <img style="width:250px !important" src="/images/add1.jpg" alt="Leicht"/>
                </div>
                <div class="col-md-3">
                    <img style="width:250px !important" src="/images/add2.png" alt="Delta"/>
				</div>
                <div class="col-md-3">
					<a href="http://bvisummersails.com/" target="_blank">
						<img style="width:250px !important" src="/images/BVI-2018-WebBanner-250x250.jpg" alt="British"/>
					</a>
                </div>
                <div class="col-md-3">
					<div>
                    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <!-- MDV columna derecha -->
                    <ins class="adsbygoogle"
                         style="display:inline-block;width:250px;height:250px"
                         data-ad-client="ca-pub-9769143677327615"
                         data-ad-slot="4673424882"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
					</script>
					</div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Intro -->
@endsection
