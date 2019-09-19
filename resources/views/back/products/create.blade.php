@extends('back.master')

@section('content')

    <div id="page-content" class="forms">
        <div class="row">

            <div class="block">

                <div class="block-title">
                    <h2><strong>Agregar</strong> Producto</h2>
                </div>

                <form action="{{ route('addProduct') }}" class="form-horizontal form-bordered" method="POST" enctype="multipart/form-data">

                    {!! csrf_field() !!}

                    <div class="form-group">
                        <label class="col-md-2 control-label"><legend><i class="fa fa-bookmark fa-fw"></i> General</legend></label>
                        <div class="col-md-10">
                            <div class="col-md-3">
                                Habilitado
                                <label class="switch switch-success">
                                    <input type="checkbox" value="1" class="form-control" name="enable" {{ old('enable') ? 'checked' : ''}} checked>
                                    <span></span>
                                </label>

                                @if ($errors->has('enable'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('enable') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3 {{ $errors->has('featured') ? ' has-error' : '' }}">
                                Destacado
                                <label class="switch switch-success">
                                    <input type="checkbox" value="1" class="form-control" name="featured" {{ old('featured') ? 'checked' : ''}}>
                                    <span></span>
                                </label>

                                @if ($errors->has('featured'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('featured') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-12 {{ $errors->has('name') ? ' has-error' : '' }}">
                                <input type="text" class="form-control" name="name" placeholder="Nombre del producto" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 {{ $errors->has('vendor_id') ? ' has-error' : '' }}">

                                <select name="vendor_id" class="form-control select-select2" data-placeholder="Proveedor">
                                    <option></option>

                                    @inject('vendors', 'App\Vendor')

                                    @foreach($vendors->all() as $vendor)
                                        <option value="{{ $vendor->id }}" {{ old('vendor_id') == $vendor->id ? 'selected' : '' }}>{{ $vendor->name }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('vendor_id'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('vendor_id') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-6 {{ $errors->has('category_id') ? ' has-error' : '' }}">
                                <select name="category_id" class="form-control select-select2" data-placeholder="Categoria">

                                    <option></option>

                                    @inject('categories', 'App\ProductCategory')

                                    @foreach($categories->main()->ordered()->get() as $mainCcat)
                                        <optgroup label="{{ $mainCcat->name }}">
                                            @foreach($mainCcat->categories()->ordered()->get() as $parentCat)
                                                @if($parentCat->is_parent)
                                                    <optgroup label="&nbsp;&nbsp;{{ $parentCat->name }}">
                                                        @foreach($parentCat->categories()->ordered()->get() as $childCat)
                                                            <option value="{{ $childCat->id }}" {{ old('category_id') == $childCat->id ? 'selected' : '' }}>&nbsp;&nbsp;&nbsp;&nbsp;{{ $childCat->name }}</option>
                                                        @endforeach
                                                    </optgroup>
                                                @else
                                                    <option value="{{ $parentCat->id }}" {{ old('category_id') == $parentCat->id ? 'selected' : '' }}>&nbsp;&nbsp;{{ $parentCat->name }}</option>
                                                @endif
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>

                                @if ($errors->has('category_id'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('category_id') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-6 {{ $errors->has('rooms') ? ' has-error' : '' }}">

                                <select name="rooms[]" multiple="multiple" class="form-control select-select2" data-placeholder="Espacios">
                                    <option></option>

                                    @inject('rooms', 'App\Room')

                                    @foreach($rooms->ordered()->get() as $room)
                                        <option value="{{ $room->id }}" {{ old('rooms') ? in_array($room->id, old('rooms')) ? 'selected' : '' : ''}}>{{ $room->name }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('room_id'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('room_id') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-6 {{ $errors->has('colors') ? ' has-error' : '' }}">

                                <select name="colors[]" multiple="multiple" class="form-control select-select2" data-placeholder="Colores">
                                    <option></option>

                                    @inject('colors', 'App\Color')

                                    @foreach($colors->ordered()->get() as $color)
                                        <option value="{{ $color->id }}" {{ old('colors') ? in_array($color->id, old('colors')) ? 'selected' : '' : ''}}>{{ $color->name }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('color_id'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('color_id') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-12 {{ $errors->has('description') ? ' has-error' : '' }}">
                                <textarea type="text" class="form-control" rows="6" name="description" placeholder="Descripción">{{ old('description') }}</textarea>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label"><legend><i class="gi gi-picture"></i> Imagenes</legend></label>
                        <div class="col-md-10">
                            <h5>Podrás cargar imagenes luego de guardar la configuración básica del producto...</h5>
                        </div>
                    </div>

                    <div class="form-group form-actions">
                        <div class="col-md-3 col-md-offset-9">
                            <button type="submit" class="btn btn-primary float-right"><i class="hi hi-check"></i> Agregar Producto</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection