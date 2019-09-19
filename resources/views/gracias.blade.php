@extends('layouts.master')

@section('meta_title')Gracias @endsection

@section('content')
    <!-- Heading -->
    <section id="heading">
        <div class="container-fluid">

            <ul class="breadcrumbs">
                <li><a href="/">MDV</a></li>
                <li class="active">
                    Gracias
                </li>
            </ul>

            <div class="section-title">
                @if(Request::has('src'))
                    @if(Request::get('src') === 'newsletter')
                        <h2>Perfecto. Ya estas suscripto al newsletter</h2>
                    @elseif(Request::get('src') === 'contacto')
                        <h2>Gracias. Hemos recibido tu mensaje</h2>
                    @else
                        <h2>Gracias!</h2>
                    @endif
                @endif
            </div>
        </div>
    </section>
    <!-- /Heading -->

    <!-- Page -->
    <section id="page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                </div>
            </div>
        </div>
    </section>
    <!-- /Page -->
@endsection