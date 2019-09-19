@extends('back.master')

@section('content')

    <div id="page-content" class="forms">
        <div class="row">

            <div class="block">

                <div class="block-title">
                    <h2><strong>Editar</strong> Producto</h2>
                </div>

                <form id="mainForm" action="{{ route('editProduct', ['id' => $product->id]) }}" class="form-horizontal form-bordered" method="POST" enctype="multipart/form-data">

                    {!! csrf_field() !!}

                    <div class="form-group">
                        <label class="col-md-2 control-label"><legend><i class="fa fa-bookmark fa-fw"></i> General</legend></label>
                        <div class="col-md-10">
                            <div class="col-md-3">
                                Habilitado
                                <label class="switch switch-success">
                                    <input type="checkbox" value="1" class="form-control" name="enable" {{ old('enable', $product->enable) ? 'checked' : ''}}>
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
                                    <input type="checkbox" value="1" class="form-control" name="featured" {{ old('featured', $product->featured) ? 'checked' : ''}}>
                                    <span></span>
                                </label>

                                @if ($errors->has('featured'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('featured') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-12 {{ $errors->has('name') ? ' has-error' : '' }}">
                                <input type="text" class="form-control" name="name" placeholder="Nombre del producto" value="{{ old('name', $product->name) }}">

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
                                        <option value="{{ $vendor->id }}" {{ old('vendor_id', $product->vendor_id) == $vendor->id ? 'selected' : '' }}>{{ $vendor->name }}</option>
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
                                                            <option value="{{ $childCat->id }}" {{ old('category_id', $product->category_id) == $childCat->id ? 'selected' : '' }}>&nbsp;&nbsp;&nbsp;&nbsp;{{ $childCat->name }}</option>
                                                        @endforeach
                                                    </optgroup>
                                                @else
                                                    <option value="{{ $parentCat->id }}" {{ old('category_id', $product->category_id) == $parentCat->id ? 'selected' : '' }}>&nbsp;&nbsp;{{ $parentCat->name }}</option>
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
                                        <option value="{{ $room->id }}" {{ in_array($room->id, ($errors->has('rooms') ? [] : $product->rooms()->pluck('id')->toArray() )) ? 'selected' : '' }}>{{ $room->name }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('rooms'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('rooms') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-6 {{ $errors->has('colors') ? ' has-error' : '' }}">

                                <select name="colors[]" multiple="multiple" class="form-control select-select2" data-placeholder="Colores">
                                    <option></option>

                                    @inject('colors', 'App\Color')

                                    @foreach($colors->ordered()->get() as $color)
                                        <option value="{{ $color->id }}" {{ in_array($color->id, ($errors->has('colors') ? [] : $product->colors()->pluck('id')->toArray() )) ? 'selected' : '' }}>{{ $color->name }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('colors'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('colors') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-12 {{ $errors->has('description') ? ' has-error' : '' }}">
                                <textarea type="text" class="form-control" rows="6" name="description" placeholder="Descripción">{{ old('description', $product->description) }}</textarea>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>

                <form id="dropImages" name="dropImages" action="{{ '/admin/images/' . Request::segment(3) }}/add" method="POST" class="dropzone form-horizontal form-bordered">
                    {!! csrf_field() !!}
                    <input type="hidden" name="typeOf" value="product">
                    <input type="hidden" name="objectId" value="{{ Request::segment(3) }}">
                    <div class="form-group">
                        <label class="col-md-2 control-label"><legend><i class="gi gi-picture"></i> Imagenes</legend></label>
                        <div class="col-md-10">
                            <span style="position: relative;top:30px;">Puedes reordenar las imagenes moviendolas de lugar. La primera será la imagen destacada.</span>
                            @push('scripts')
                            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
                            <script src="/back/js/mdv_dropzone.js"></script>
                            @endpush
                        </div>
                    </div>

                </form>

                <div class="form-group form-actions">
                    <div class="col-md-3 col-md-offset-9">
                        @push('scripts')
                        <script>
                            $('#submitMainForm').click(function (e) {
                                $('#mainForm').submit();
                            })
                        </script>
                        @endpush
                        <a id="submitMainForm" class="btn btn-primary float-right"><i class="hi hi-check"></i> Guardar Cambios</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->

    <!-- Dropzone Preview Template -->
    <div id="preview-template" style="display: none;">

        <div class="dz-preview dz-file-preview">
            <div class="dz-image"><img data-dz-thumbnail=""></div>
            <input type="hidden" class="serverfilename"/>

            <div class="dz-details">
                <div class="dz-size"><span data-dz-size=""></span></div>
                <div class="dz-filename"><span data-dz-name=""></span></div>
            </div>
            <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress=""></span></div>
            <div class="dz-error-message"><span data-dz-errormessage=""></span></div>

            <div class="dz-success-mark">
                <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                    <!-- Generator: Sketch 3.2.1 (9971) - http://www.bohemiancoding.com/sketch -->
                    <title>Check</title>
                    <desc>Created with Sketch.</desc>
                    <defs></defs>
                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                        <path d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475" fill="#FFFFFF" sketch:type="MSShapeGroup"></path>
                    </g>
                </svg>
            </div>

            <div class="dz-error-mark">
                <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                    <!-- Generator: Sketch 3.2.1 (9971) - http://www.bohemiancoding.com/sketch -->
                    <title>error</title>
                    <desc>Created with Sketch.</desc>
                    <defs></defs>
                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                        <g id="Check-+-Oval-2" sketch:type="MSLayerGroup" stroke="#747474" stroke-opacity="0.198794158" fill="#FFFFFF" fill-opacity="0.816519475">
                            <path d="M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" sketch:type="MSShapeGroup"></path>
                        </g>
                    </g>
                </svg>
            </div>

        </div>
    </div>
    <!-- End Dropzone Preview Template -->
@endsection