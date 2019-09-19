@extends('layouts.master')

@section('meta_title')Contacto @endsection

@section('extra_tags')
    <script src='https://www.google.com/recaptcha/api.js'></script>
@endsection

@section('content')
    <!-- Heading -->
    <section id="heading">
        <div class="container-fluid">

            <ul class="breadcrumbs">
                <li><a href="/">MDV</a></li>
                <li class="active">
                    Contacto
                </li>
            </ul>

            <div class="section-title">
                <h2>Contacto
                </h2>
            </div>
        </div>
    </section>
    <!-- /Heading -->

    <!-- Page -->
    <section id="page">
        <div class="container">

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                <div class="col-md-6">
                    <form id="frm-contact" method="post">
                        {!! csrf_field() !!}
                        <div class="col-md-12 col-sm-12">
                            <div class="frm-wrap">
                                <label>Nombre <span class="req">*</span></label>
                                <input name="name" type="text" class="frm-text" required="">
                            </div>
                            <div class="frm-wrap">
                                <label>Email <span class="req">*</span></label>
                                <input type="hidden" type="email" name="email">
                                <input name="correo" type="email" class="frm-text" required="">
                            </div>
                            <div class="frm-wrap">
                                <label>Asunto</label>
                                <input name="subject" type="text" class="frm-text">
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="frm-wrap">
                                <label>Mensaje <span class="req">*</span></label>
                                <textarea name="message" class="frm-textarea" cols="10" rows="10" required=""></textarea>
                            </div>
                            <div class="frm-wrap">
                                <div class="g-recaptcha" data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}"></div>
                                <input type="submit" class="frm-submit" value="ENVIAR">
                                <small><span class="req">*</span> campos requeridos</small>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-sm-6">
                            <span style="text-align: left;"><strong>DIRECTORA &nbsp;&nbsp;</strong>&nbsp;&nbsp;&nbsp;</span>
                            <p>Bibi Liaño&nbsp;<br>787.502.1346 cel.<br>787.755.6691 tel / fax &nbsp; &nbsp; &nbsp;&nbsp;<br><a href="mailto:info@mododevida.com">info@mododevida.com</a><a href="mailto:info@mododevida.com" target="_blank"></a></p>
                            <p>&nbsp;</p>
                            <p><strong>GERENTE EDITORIAL &nbsp; &nbsp;&nbsp;</strong>&nbsp;&nbsp;&nbsp;</p>
                            <p>Adriana Cañellas, CODDI<br>787.587.6222 cel.<br><a href="mailto:adriana.mododevida@gmail.com">adriana.mododevida@gmail.com</a></p>
                            <p style="text-align: left;">&nbsp;</p>
                            <p><strong>DIRECTORA DE VENTAS</strong></p>
                            <p>Aileen Vidal&nbsp;<br>787.923.2688 cel.<br>787.760.3282 tel/ fax<br><a href="mailto:aileen@mododevida.com">aileen@mododevida.com</a><br><a href="mailto:aileenv@prtc.net">aileenv@prtc.net</a><a href="mailto:aileenv@prtc.net"></a></p>
                            <p>&nbsp;</p>
                        </div>
                        <div class="col-sm-6">
                            <span><strong>REPRESENTANTE DE VENTAS IMPRESA Y DIGITAL</strong></span>
                            <p>Aileen Vidal&nbsp;<br>787.923.2688 cel.<br>787.760.3282 tel/ fax<br><a href="mailto:aileen@mododevida.com">aileen@mododevida.com</a><br><a href="mailto:aileenv@prtc.net">aileenv@prtc.net</a></p>
                            <p>Myriam Arana Ocasio<br>787.548.6673<br><a href="mailto:myriam@mododevida.com">myriam@mododevida.com</a></p>
                            <p><strong>FOTÓGRAFO &nbsp; &nbsp;&nbsp;</strong>&nbsp;&nbsp;&nbsp;</p>
                            <p>Carlos Esteva<br>787-758-5062<br><a href="mailto:esteva@coqui.net">esteva@coqui.net</a></p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- /Page -->
@endsection