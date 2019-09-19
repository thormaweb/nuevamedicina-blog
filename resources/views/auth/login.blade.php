@extends('layouts.auth')

@section('content')
    <!-- Login Form -->
    <form action="/login" method="post" id="form-login" class="form-horizontal form-bordered form-control-borderless">
        {{ csrf_field() }}
        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
            <div class="col-xs-12">
                <div class="input-group">
                    <span class="input-group-addon"><i class="gi gi-envelope"></i></span>
                    <input type="email" id="login-email" name="email" class="form-control input-lg" placeholder="Correo" value="{{ old('email') }}">
                </div>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
            <div class="col-xs-12">
                <div class="input-group">
                    <span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
                    <input type="password" id="login-password" name="password" class="form-control input-lg" placeholder="Contraseña"">
                </div>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group form-actions">
            <div class="col-xs-4">
                <label class="switch switch-primary" data-toggle="tooltip" title="Recordarme?">
                    <input type="checkbox" id="login-remember-me" name="remember" checked>
                    <span></span>
                </label>
            </div>
            <div class="col-xs-8 text-right">
                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> Ingresar</button>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-12 text-center">
                <a href="/password/reset" id="link-reminder-login"><small>Olvidaste tu contraseña?</small></a>
            </div>
        </div>
    </form>
    <!-- END Login Form -->
@endsection