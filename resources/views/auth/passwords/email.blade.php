@extends('layouts.auth')

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ url('/password/email') }}" id="form-reminder" class="form-horizontal form-bordered form-control-borderless" novalidate="novalidate" style="display: block;">
        {{ csrf_field() }}

        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
            <div class="col-xs-12">
                <div class="input-group">
                    <span class="input-group-addon"><i class="gi gi-envelope"></i></span>
                    <input id="reminder-email" type="email" class="form-control input-lg" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="form-group form-actions">
            <div class="col-xs-12 text-right">
                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> Solicitar contraseña</button>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-12 text-center">
                <small>Recordaste tu contraseña?</small> <a href="/login" id="link-reminder"><small>Login</small></a>
            </div>
        </div>
    </form>
@endsection
