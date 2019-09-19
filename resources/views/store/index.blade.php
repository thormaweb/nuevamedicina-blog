@extends('layouts.master')

@section('meta_title')Modo de Vida | Tienda @endsection

@section('content')
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-sm-12">

                </div>
            </div>
        </div>
    </section>
    <div class="divider"></div>
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-sm-6">

                    <!-- single block -->
                    <div class="block">
                        <div class="photo">
                            <a href="/tienda/decoracion">
                                <img src="/images/productos_decoracion.jpg" alt="Productos Decoración"/>
                            </a>
                        </div>
                        <div class="title">
                            {{--<h2>PRODUCTOS DECORACIÓN</h2>--}}
                        </div>
                    </div>
                    <!-- /single block -->

                </div>
                <div class="col-md-6 col-sm-6">

                    <!-- single block -->
                    <div class="block">
                        <div class="photo">
                            <a href="/tienda/remodelacion">
                                <img src="/images/productos_remodelacion.jpg" alt="Productos Remodelación"/>
                            </a>
                        </div>
                        <div class="title">
                            {{--<h2>PRODUCTOS REMODELACIÓN</h2>--}}
                        </div>
                    </div>
                    <!-- /single block -->

                </div>
            </div>
        </div>
    </section>
    <div class="divider"></div>
@endsection