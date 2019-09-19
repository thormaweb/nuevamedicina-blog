@extends('back.master')

@section('content')

    <div id="page-content">
        <div class="row">

            <div class="block">
                <!-- Example Form Title -->
                <div class="block-title">
                    <h2><strong>Editar</strong> Proveedor</h2>
                </div>
                <!-- END Example Form Title -->


                <!-- Example Form Content -->
                <form action="{{ route('editVendor', ['id' => $vendor->id]) }}" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">

                    {!! csrf_field() !!}

                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Proveedor</label>

                        <div class="col-md-9">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="gi gi-shop"></i></span>
                                <input type="text" name="name" class="form-control" placeholder="Nombre de la tienda" value="{{ old('name', $vendor->name) }}">
                            </div>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('website') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Sitio web</label>

                        <div class="col-md-9">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="gi gi-global"></i></span>
                                <input type="text" name="website" class="form-control" placeholder="Dirección del Shop" value="{{ old('website', $vendor->website) }}">
                            </div>

                            @if ($errors->has('website'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('website') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Teléfono</label>

                        <div class="col-md-9">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="gi gi-earphone"></i></span>
                                <input type="text" name="phone" class="form-control" placeholder="Número de contacto" value="{{ old('phone', $vendor->phone) }}">
                            </div>

                            @if ($errors->has('phone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Email</label>

                        <div class="col-md-9">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="gi gi-envelope"></i></span>
                                <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email', $vendor->email) }}">
                            </div>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Descripción</label>

                        <div class="col-md-9">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="gi gi-flash"></i></span>
                                <textarea name="description" class="form-control" placeholder="Resumen/presentación del proveedor...">{{ old('description', $vendor->description) }}</textarea>
                            </div>

                            @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    {{--<div class="form-group{{ $errors->has('logo') ? ' has-error' : '' }}">--}}
                    {{--<label class="col-md-3 control-label">Logo</label>--}}

                    {{--<div class="col-md-4">--}}
                    {{--<input type="file" class="form-control" name="logo"">--}}

                    {{--@if ($errors->has('logo'))--}}
                    {{--<span class="help-block">--}}
                    {{--<strong>{{ $errors->first('logo') }}</strong>--}}
                    {{--</span>--}}
                    {{--@endif--}}
                    {{--</div>--}}
                    {{--<div class="col-md-3"><span>Logo/imagen del Proveedor en tamaño 540 x 540 (px)</span></div>--}}
                    {{--</div>--}}
                    <input type="hidden" name="logo" value="logo.png">

                    <div class="form-group form-actions">
                        <div class="col-md-9 col-md-offset-3">
                            <button type="submit" class="btn btn-primary pull-right"> Guardar Cambios</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <!-- END Page Content -->
@endsection