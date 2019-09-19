@extends('layouts.master')

@section('meta_title')Buscador @endsection

@section('content')
    <!-- Heading -->
    <section id="heading">
        <div class="container-fluid">

            <ul class="breadcrumbs">
                <li><a href="/">MDV</a></li>
                <li><a href="{{ route('store') }}">Tienda</a></li>
                <li class="active">
                    Busqueda: {{ $search }}
                </li>
            </ul>

            <div class="section-title">
                <h2>@if($products->count() == 0)
                       No encontramos resultados para <strong>{{ $search }}</strong>
                    @else
                        Resultados de busqueda para: {{ $search }}
                    @endif
                </h2>
            </div>
        </div>
    </section>
    <!-- /Heading -->

    <!-- Products -->
    <section id="products">
        <div class="container-fluid">
            {{--@include('store._filters')--}}
            <div class="grid-list">
                <ul>
                    <!-- single product -->
                    @foreach($products as $product)
                        @if($product->featuredImage())
                            <li class="col-md-4 col-sm-6">
                                <div class="prod">
                                    <div class="photo">
                                        <a href="{{ route('product', [$product->vendor->slug, $product->slug]) }}">
                                            <img src="/photos/{{ $product->featuredImage()->url }}" alt="{{ $product->name }}"/>
                                        </a>
                                    </div>
                                    <div class="rating">
                                        {{--<img style="width:100px !important" src="/images/prod/stars.jpg">--}}
                                    </div>
                                    <div class="title">
                                        <h2><a href="{{ route('product', [$product->vendor->slug, $product->slug]) }}">
                                                {{ $product->name }}
                                            </a></h2>
                                    </div>
                                </div>
                            </li>
                    @endif
                @endforeach
                <!-- /single product -->
                </ul>

            </div>

            <div class="pagenavi m-t-40">
                {{ $products->links() }}
            </div>
        </div>
    </section>
    <!-- /Products -->
@endsection