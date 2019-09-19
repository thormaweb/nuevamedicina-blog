@extends('layouts.master')

@section('meta_title')Revista Modo de Vida @endsection

@section('content')
    <!-- Heading -->
    <section id="heading">
        <div class="container-fluid">

            <ul class="breadcrumbs">
                <li><a href="/">MDV</a></li>
                <li class="active">Revista Modo de Vida</li>
            </ul>

            <div class="section-title">
                <h2>Pasadas Ediciones | Revista Modo de Vida</h2>
            </div>
        </div>
    </section>
    <!-- /Heading -->

    <!-- Category -->
    <section id="category">
        <div class="container-fluid">
            <div class="row">
                <div class="grid-list posts">
                    <ul>

                        @foreach($magazines as $magazine)
                            <li class="col-md-4 col-xs-12">
                                <div class="post" style="height: 235px;">
                                    <a href="{{ route('magazine', [$magazine->slug]) }}">
                                        <div class="photo" style="background-image: url('/files/revista/{{ $magazine->thumbnail }}');
                                                width: 45%;
                                                float: left;
                                                margin-right: 20px;
                                                height: 200px;">
                                        </div>
                                    </a>
                                    <div class="title">
                                        <h2><a href="{{ route('magazine', [$magazine->slug]) }}">{{ $magazine->name }}</a></h2>
                                        <p>{!! $magazine->getShortDescription() !!}</p>
                                    </div>
                                </div>
                            </li>
                        @endforeach

                    </ul>
                </div>


                <div class="pagenavi m-t-40">
                    {{ $magazines->links() }}
                </div>

            </div>
        </div>
    </section>
    <!-- /Category -->
@endsection