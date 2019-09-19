@extends('layouts.master')

@section('meta_title')Artículos @endsection

@section('content')
    <!-- Heading -->
    <section id="heading">
        <div class="container-fluid">

            <ul class="breadcrumbs">
                <li><a href="/">MDV</a></li>
                <li><a href="{{ route('articles') }}">Articulos</a></li>
                @if(isset($category))
                    <li class="active">{{ $category->name }}</li>
                @else
                    <li class="active">Todos los articulos</li>
                @endif
            </ul>

            <div class="section-title">
                @if(isset($category))
                    <h1>{{ $category->name }}</h1>
                @else
                    <h1>Todos los articulos</h1>
                @endif
            </div>
        </div>
    </section>
    <!-- /Heading -->

    <!-- Category -->
    <section id="category">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-sm-3">

                    <!-- category list -->
                    <div class="cat-list">
                        <ul>
                            <li class="{{ ! isset($category) ? 'active' : ''}}"><a href="{{ route('articles') }}">Todos los articulos</a></li>
                            @inject('categories', 'App\ArticleCategory')
                            @foreach($categories->ordered()->get() as $cat)
                                <li class="{{ isset($category) ? ($category->id == $cat->id) ? 'active' : '' : ''}}"><a href="{{ route('articleCategory', $cat->slug) }}">{{ $cat->name }}</a></li>
                            @endforeach

                        </ul>
                    </div>
                    <!-- /category list -->

                </div>
                <div class="col-md-9 col-sm-9">
                    <div class="grid-list posts">
                        <ul>

                            @foreach($articles as $article)
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


                    <div class="pagenavi m-t-40">
                        {{ $articles->links() }}
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- /Category -->
@endsection