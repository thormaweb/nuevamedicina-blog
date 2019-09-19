@extends('layouts.master')

@section('meta_title')Suscripciones @endsection

@section('content')
    <!-- Heading -->
    <section id="heading">
        <div class="container-fluid">

            <ul class="breadcrumbs">
                <li><a href="/">MDV</a></li>
                <li class="active">
                    Suscripciones
                </li>
            </ul>

            <div class="section-title">
                <h2>Suscripciones
                </h2>
            </div>
        </div>
    </section>
    <!-- /Heading -->

    <!-- Page -->
    <section id="page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text m-t-20">
                        <div id="my-store-1668070"></div>
                        <div>
                            <script type="text/javascript" src="https://app.ecwid.com/script.js?1668070&data_platform=code&data_date=2017-03-14" charset="utf-8"></script><script type="text/javascript"> xProductBrowser("categoriesPerRow=3","views=grid(20,3) list(60) table(60)","categoryView=grid","searchView=list","id=my-store-1668070");</script>
                        </div>
                        {{--<img src="/images/suscripciones.jpg" width="900" alt="Suscripciones"/>--}}
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- /Page -->
@endsection