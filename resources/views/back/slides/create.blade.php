@extends('back.master')

@section('content')

    <div id="page-content" class="forms">
        <div class="row">

            <div class="block">

                <div class="block-title">
                    <h2><strong>Agregar</strong> Slide</h2>
                </div>

                <form action="{{ route('addSlide') }}" class="form-horizontal form-bordered" method="POST" enctype="multipart/form-data">

                    {!! csrf_field() !!}

                    <div class="form-group">
                        <label class="col-md-2 control-label"><legend><i class="fa fa-bookmark fa-fw"></i> General</legend></label>
                        <div class="col-md-10">
                            {{--<div class="col-md-3">--}}
                            {{--Habilitado--}}
                            {{--<label class="switch switch-success">--}}
                            {{--<input type="checkbox" value="1" class="form-control" name="enable" {{ old('enable', $slide->enable) ? 'checked' : ''}}>--}}
                            {{--<span></span>--}}
                            {{--</label>--}}

                            {{--@if ($errors->has('enable'))--}}
                            {{--<span class="help-block">--}}
                            {{--<strong>{{ $errors->first('enable') }}</strong>--}}
                            {{--</span>--}}
                            {{--@endif--}}
                            {{--</div>--}}
                            <div class="col-md-3 {{ $errors->has('order') ? ' has-error' : '' }}">

                                <label class="col-md-3 control-label">Orden</label>
                                <div class="col-md-5">
                                    <input type="number" class="form-control" name="order" value="{{ old('order')}}">
                                </div>

                                @if ($errors->has('order'))
                                    <span class="help-block col-md-12">
                                        <strong>{{ $errors->first('order') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 {{ $errors->has('image') ? ' has-error' : '' }}">

                                <div class="image-upload {{ $errors->has('image') ? ' has-error' : '' }}">

                                    <label class="btn btn-primary" for="my-file-selector">
                                        <input id="my-file-selector" name="image" type="file" style="display:none;" onchange="$('#upload-file-info').html('Nueva imagen: ' + $(this).val().replace(/^.*\\/g, ''));">
                                        Subir Imagen
                                    </label>
                                    <span class='label label-info' id="upload-file-info"></span>
                                </div>

                                @if ($errors->has('image'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="col-md-12 {{ $errors->has('title') ? ' has-error' : '' }}">
                                <input type="text" class="form-control" name="title" placeholder="Titulo" value="{{ old('title') }}">

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-12 {{ $errors->has('description') ? ' has-error' : '' }}">
                                <input type="text" class="form-control" name="description" placeholder="Descripción" value="{{ old('description') }}">

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-12 {{ $errors->has('link') ? ' has-error' : '' }}">
                                <input type="text" class="form-control" name="link" placeholder="Link (ej; https://www.mododevida.com/categoria" value="{{ old('link') }}">

                                @if ($errors->has('link'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('link') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group form-actions">
                        <div class="col-md-3 col-md-offset-9">
                            <input type="hidden" name="slider" value="home">
                            <button type="submit" class="btn btn-primary float-right"><i class="hi hi-check"></i> Agregar Slide</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection