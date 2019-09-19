@extends('back.master')

@section('content')

    <div id="page-content">
        <div class="row">
            <div class="col-md-6">
                <div class="block">
                    <!-- Example Form Title -->
                    <div class="block-title">
                        <h2>Crear Usuario</h2>
                    </div>
                    <!-- END Example Form Title -->

                    <!-- Example Form Content -->
                    <form action="{{ route('addUser') }}" class="form-horizontal form-bordered" method="post">

                        {!! csrf_field() !!}

                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Nombre</label>

                            <div class="col-md-9">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="gi gi-user"></i></span>
                                    <input type="text" name="name" class="form-control" placeholder="Nombre" value="{{ old('name') }}">
                                </div>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Email</label>

                            <div class="col-md-9">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="gi gi-envelope"></i></span>
                                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                                </div>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Rol</label>
                            <div class="col-md-9">
                                <select name="role_id" class="form-control select-select2">
                                    @inject('roles', 'App\Role')
                                    @foreach($roles->all() as $role)
                                        @if($role->name != 'front_user')
                                            <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ $role->display_name }}</option>
                                        @endif
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="form-group form-actions">
                            <div class="col-md-9 col-md-offset-3">
                                <button type="submit" class="btn btn-primary pull-right"> Crear Usuario</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

            <div class="col-md-6">
                <!-- Block with Options -->
                <div class="block">
                    <!-- Block with Options Title -->
                    <div class="block-title">
                        <h2>Tenga en cuenta</h2>
                    </div>
                    <!-- END Block with Options Title -->

                    <!-- Block with Options Content -->
                    <p>Los permisos para cada rol son los siguientes:</p>
                    <style>
                        ul#roles_and_perms {
                            list-style: none;
                            columns: 3;
                            -webkit-columns: 3;
                            -moz-columns: 3;
                        }
                    </style>
                    @foreach($roles->all() as $role)
                        @if($role->name != 'front_user')
                            <h5>{{ $role->display_name }}</h5>
                            <ul id="roles_and_perms">
                                @foreach($role->perms as $permission)
                                    <li>{{ $permission->display_name }}</li>
                                @endforeach
                            </ul>
                    @endif
                @endforeach

                <!-- END Block with Options Content -->
                </div>
                <!-- END Block with Options -->
            </div>
        </div>

    </div>
    <!-- END Page Content -->
@endsection