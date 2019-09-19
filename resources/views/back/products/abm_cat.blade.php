@extends('back.master')

@section('content')

    <div id="page-content" class="forms">
        <div class="row">

            <div class="block">

                <div class="block-title">
                    <div class="block-options pull-right">
                        <a onclick="nuevaCat()" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="" data-original-title="Nueva Categoria"><i class="gi gi-git_create"></i></a>
                        <a onclick="actualizarCat()" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="" data-original-title="Actualizar Categoria"><i class="gi gi-git_delete"></i></a>
                        <a onclick="mergeCat()" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="" data-original-title="Mergear Categorias"><i class="gi gi-git_pull_request"></i></a>
                    </div>
                    <h2><strong>ABM</strong> Categories</h2>
                </div>

                @if(session()->has('flash_message'))
                    <div class="alert alert-{{ session()->get('flash_message') }}" role="alert">
                        <strong>{{ session()->get('message_strong') }}</strong> {{ session()->get('message') }}
                    </div>
                @endif

                @push('scripts')
                <script>
                    const nuevaCat = () => {
                        $('#nuevaCat').removeClass('display-none').addClass('animated fadeInLeftBig');
                        $('#actualizarCat').addClass('display-none');
                        $('#mergeCat').addClass('display-none');
                    }

                    const actualizarCat = () => {
                        $('#actualizarCat').removeClass('display-none').addClass('animated fadeInLeftBig');
                        $('#nuevaCat').addClass('display-none');
                        $('#mergeCat').addClass('display-none');
                    }

                    const mergeCat = () => {
                        $('#mergeCat').removeClass('display-none').addClass('animated fadeInLeftBig');
                        $('#nuevaCat').addClass('display-none');
                        $('#actualizarCat').addClass('display-none');
                    }
                </script>
                @endpush
                <style>
                    .select2.select2-container.select2-container--default.select2-container--focus,
                    .select2.select2-container.select2-container--default{
                        width: 100% !important;
                    }
                </style>

                <form id="nuevaCat" action="/admin/abm-categorias" class="form-horizontal form-bordered" method="POST">

                    {!! csrf_field() !!}

                    <div class="form-group">
                        <label class="col-md-3 control-label"><legend>Nueva Categoria</legend></label>
                        <div class="col-md-9">
                            <div class="col-md-3">
                                Es padre
                                <label class="switch switch-success">
                                    <input type="checkbox" value="1" class="form-control" name="is_parent" {{ old('is_parent') ? 'checked' : ''}}>
                                    <span></span>
                                </label>

                                @if ($errors->has('is_parent'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('is_parent') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4 {{ $errors->has('parent_id') ? ' has-error' : '' }}">
                                <label class="col-md-3 control-label">Id del padre</label>
                                <div class="col-md-5">
                                    <input type="number" class="form-control" name="parent_id" value="{{ old('parent_id')}}">
                                </div>

                                @if ($errors->has('parent_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('parent_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4 {{ $errors->has('order') ? ' has-error' : '' }}">
                                <label class="col-md-3 control-label">Orden</label>
                                <div class="col-md-5">
                                    <input type="number" class="form-control" name="order" value="{{ old('order')}}">
                                </div>

                                @if ($errors->has('order'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('order') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-12 {{ $errors->has('name') ? ' has-error' : '' }}">
                                <input type="text" class="form-control" name="name" placeholder="Nombre de la categoria" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group form-actions">
                        <div class="col-md-3 col-md-offset-9">
                            <button type="submit" class="btn btn-primary float-right"><i class="hi hi-check"></i> Agregar Categoria</button>
                        </div>
                    </div>
                </form>

                <form id="actualizarCat" action="/admin/abm-categorias/update" class="form-horizontal form-bordered display-none" method="POST">

                    {!! csrf_field() !!}

                    <div class="form-group">
                        <label class="col-md-3 control-label"><legend>Actualizar Categoria</legend></label>
                        <div class="col-md-9">
                            <div class="col-md-12 {{ $errors->has('category_id') ? ' has-error' : '' }}">
                                @push('scripts')
                                <script>
                                    let categoryForm = $('#catId');
                                    categoryForm.on("select2:select", function() {
                                        let category = categoryForm.select2().find(":selected").data("cat");
                                        $('#name').val(category.name);
                                        if (category.is_parent == 1){
                                            $('#is_parent').prop('checked', true);
                                        } else {
                                            $('#is_parent').prop('checked', false);
                                        }
                                        $('#slug').val(category.slug);
                                        $('#parent_id').val(category.parent_id);
                                        $('#order').val(category.order);
                                    })
                                </script>
                                @endpush
                                <select id="catId" name="category_id" class="form-control select-select2" data-placeholder="Categoria">

                                    <option></option>

                                    @inject('categories', 'App\ProductCategory')

                                    @foreach($categories->main()->ordered()->get() as $mainCat)
                                        <option data-cat="{{ $mainCat }}" value="{{ $mainCat->id }}"> >>{{ $mainCat->name }}</option>
                                        @foreach($mainCat->categories()->ordered()->get() as $parentCat)
                                            @if($parentCat->is_parent)
                                                <option data-cat="{{ $parentCat }}"  value="{{ $parentCat->id }}">&nbsp;&nbsp;>>>>{{ $parentCat->name }}</option>
                                                @foreach($parentCat->categories()->ordered()->get() as $childCat)
                                                    <option data-cat="{{ $childCat }}"  value="{{ $childCat->id }}" {{ old('category_id') == $childCat->id ? 'selected' : '' }}>&nbsp;&nbsp;&nbsp;&nbsp;{{ $childCat->name }}</option>
                                                @endforeach
                                            @else
                                                <option data-cat="{{ $parentCat }}" value="{{ $parentCat->id }}" {{ old('category_id') == $parentCat->id ? 'selected' : '' }}>&nbsp;&nbsp;>>>>{{ $parentCat->name }}</option>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </select>

                                @if ($errors->has('category_id'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('category_id') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-3">
                                Es padre
                                <label class="switch switch-success">
                                    <input id="is_parent" type="checkbox" value="1" class="form-control" name="is_parent" {{ old('is_parent') ? 'checked' : ''}}>
                                    <span></span>
                                </label>

                                @if ($errors->has('is_parent'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('is_parent') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4 {{ $errors->has('parent_id') ? ' has-error' : '' }}">
                                <label class="col-md-3 control-label">Id del padre</label>
                                <div class="col-md-5">
                                    <input id="parent_id" type="number" class="form-control" name="parent_id" value="{{ old('parent_id')}}">
                                </div>

                                @if ($errors->has('parent_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('parent_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4 {{ $errors->has('order') ? ' has-error' : '' }}">
                                <label class="col-md-3 control-label">Orden</label>
                                <div class="col-md-5">
                                    <input id="order" type="number" class="form-control" name="order" value="{{ old('order')}}">
                                </div>

                                @if ($errors->has('order'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('order') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 {{ $errors->has('name') ? ' has-error' : '' }}">
                                <input id="name" type="text" class="form-control" name="name" placeholder="Nombre de la categoria" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 {{ $errors->has('slug') ? ' has-error' : '' }}">
                                <input id="slug" type="text" class="form-control" name="slug" placeholder="Nombre de la categoria" value="{{ old('slug') }}">

                                @if ($errors->has('slug'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('slug') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group form-actions">
                        <div class="col-md-3 col-md-offset-9">
                            <button type="submit" class="btn btn-primary float-right"><i class="hi hi-check"></i> Actualizar Categoria</button>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="eliminar" placeholder="ELIMINAR??" value="">
                        </div>
                    </div>
                </form>

                <form id="mergeCat" action="/admin/abm-categorias/merge" class="form-horizontal form-bordered display-none" method="POST">

                    {!! csrf_field() !!}

                    <div class="form-group">
                        <label class="col-md-3 control-label"><legend>Mergear Categorias</legend></label>
                        <div class="col-md-9">
                            <div class="col-md-5">

                                <select name="merge_this_id" class="form-control select-select2" data-placeholder="Mergea esta categoria">

                                    <option></option>

                                    @foreach($categories->main()->ordered()->get() as $mainCat)
                                        <option data-cat="{{ $mainCat }}" value="{{ $mainCat->id }}"> >>{{ $mainCat->name }}</option>
                                        @foreach($mainCat->categories()->ordered()->get() as $parentCat)
                                            @if($parentCat->is_parent)
                                                <option value="{{ $parentCat->id }}">&nbsp;&nbsp;>>>>{{ $parentCat->name }}</option>
                                                @foreach($parentCat->categories()->ordered()->get() as $childCat)
                                                    <option value="{{ $childCat->id }}" {{ old('category_id') == $childCat->id ? 'selected' : '' }}>&nbsp;&nbsp;&nbsp;&nbsp;{{ $childCat->name }}</option>
                                                @endforeach
                                            @else
                                                <option value="{{ $parentCat->id }}" {{ old('category_id') == $parentCat->id ? 'selected' : '' }}>&nbsp;&nbsp;>>>>{{ $parentCat->name }}</option>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </select>

                                @if ($errors->has('category_id'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('category_id') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div style="text-align: center" class="col-md-2"><p>=></p></div>
                            <div class="col-md-5">

                                <select name="into_this_id" class="form-control select-select2" data-placeholder="Dentro de esta categoria">

                                    <option></option>

                                    @foreach($categories->main()->ordered()->get() as $mainCat)
                                        <option data-cat="{{ $mainCat }}" value="{{ $mainCat->id }}"> >>{{ $mainCat->name }}</option>
                                        @foreach($mainCat->categories()->ordered()->get() as $parentCat)
                                            @if($parentCat->is_parent)
                                                <option value="{{ $parentCat->id }}">&nbsp;&nbsp;>>>>{{ $parentCat->name }}</option>
                                                @foreach($parentCat->categories()->ordered()->get() as $childCat)
                                                    <option value="{{ $childCat->id }}" {{ old('category_id') == $childCat->id ? 'selected' : '' }}>&nbsp;&nbsp;&nbsp;&nbsp;{{ $childCat->name }}</option>
                                                @endforeach
                                            @else
                                                <option value="{{ $parentCat->id }}" {{ old('category_id') == $parentCat->id ? 'selected' : '' }}>&nbsp;&nbsp;>>>>{{ $parentCat->name }}</option>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </select>

                                @if ($errors->has('category_id'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('category_id') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group form-actions">
                        <div class="col-md-3 col-md-offset-9">
                            <button type="submit" class="btn btn-primary float-right"><i class="hi hi-check"></i> Mergear Categoria</button>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="seguro" placeholder="SEGURO??" value="">
                        </div>
                    </div>
                </form>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label"><legend><i class="gi gi-folder_open"></i>  Listado actual</legend></label>
                <div class="col-md-8">

                    @foreach($categories->main()->ordered()->get() as $mainCat)
                        <h3>
                            {{ $mainCat->order }} - ({{ $mainCat->id }}){{ $mainCat->name }} => {{ $mainCat->products()->count() }}
                        </h3>
                        @foreach($mainCat->categories()->ordered()->get() as $parentCat)
                            @if($parentCat->is_parent)
                                <h4>&nbsp;&nbsp;{{ $parentCat->order }} - ({{ $parentCat->id }}){{ $parentCat->name }} => {{ $parentCat->products()->count() }}</h4>
                                @foreach($parentCat->categories()->ordered()->get() as $childCat)
                                    <h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $childCat->order }} - ({{ $childCat->id }}){{ $childCat->name }} => {{ $childCat->products()->count() }}</h4>
                                @endforeach
                            @else
                                <h4>&nbsp;&nbsp;{{ $parentCat->order }} - ({{ $parentCat->id }}){{ $parentCat->name }} => {{ $parentCat->products()->count() }}</h4>
                            @endif
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection