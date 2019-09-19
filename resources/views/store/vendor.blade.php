@extends('layouts.master')

@section('meta_title'){{ $vendor->name }}| Tienda @endsection

@section('content')
    <!-- Heading -->
    <section id="heading">
        <div class="container-fluid">

            <ul class="breadcrumbs">
                <li><a href="/">MDV</a></li>
                <li><a href="{{ route('store') }}">Tienda</a></li>
                <li class="active">
                    {{ $vendor->name }}
                </li>
            </ul>

            <div class="section-title">
                <h2>
                    {{ $vendor->name }}
                </h2>
            </div>
        </div>
    </section>
    <!-- /Heading -->

    <section id="page">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="text">
                        {{ $vendor->description }}
                    </div>
                    <div class="details">
                        <ul>
                            <li itemprop="name"><strong>Tienda</strong> {{ $vendor->name }}</li>
                            <li><strong>Website</strong> <a href="http://{{ $vendor->website }}" rel="nofollow" target="_blank"> {{ $vendor->website }}</a></li>
                            <li><strong>Teléfono</strong> {{ $vendor->phone }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Products -->
    <section id="products">
        <div class="container-fluid">
            <div class="grid-list">
                <ul>
                    <!-- single product -->
                    @foreach($vendor->products as $product)
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

            {{--<div class="pagenavi m-t-40">--}}
                {{--{{ $products->links() }}--}}
            {{--</div>--}}
        </div>
    </section>
    <!-- /Products -->
@endsection