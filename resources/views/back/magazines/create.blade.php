@extends('back.master')

@section('content')

    <div id="page-content" class="forms">
        <div class="row">

            <div class="block">

                <div class="block-title">
                    <h2><strong>Agregar</strong> Revista</h2>
                </div>

                <form action="{{ route('addMagazine') }}" class="form-horizontal form-bordered" method="POST" enctype="multipart/form-data">

                    {!! csrf_field() !!}

                    <div class="form-group">
                        <label class="col-md-2 control-label"><legend><i class="fa fa-bookmark fa-fw"></i> General</legend></label>
                        <div class="col-md-10">
                            <div class="col-md-2"><h4>Edición:</h4></div>
                            <div class="col-md-2 {{ $errors->has('month') ? ' has-error' : '' }}">
                                <select type="text" class="form-control" name="month">
                                    @foreach(\App\Magazine::$months as $num => $month)
                                        <option value="{{ $num }}" @if($errors->count() > 1) {{old('month') == $num ? 'selected' : ''}} @else {{date('m') + 1 == $num ? 'selected' : ''}} @endif>{{ $month }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('month'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('month') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3 {{ $errors->has('year') ? ' has-error' : '' }}">
                                <select type="text" class="form-control" name="year">
                                    <option value="{{ date('Y') }}" {{old('year') == date('Y') ? 'selected' : ''}}>{{ date('Y') }}</option>
                                    <option value="{{ date('Y') + 1 }}" {{old('year') == date('Y') + 1 ? 'selected' : ''}}>{{ date('Y') + 1 }}</option>
                                </select>

                                @if ($errors->has('year'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('year') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-5">
                                <label class="col-md-6 control-label">Fecha Habilitada</label>
                                <div class="col-md-6">
                                    <input type="text" name="published_on" class="form-control input-datepicker" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" value="{{$errors->count() > 1 ? old('published_on') : date('Y-m-d', strtotime('first day of +1 month'))}}">

                                    @if ($errors->has('enable'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('enable') }}</strong>
                                    </span>
                                    @endif
                                </div>

                            </div>
                            <div class="col-md-3 {{ $errors->has('issuu_active') ? ' has-error' : '' }}">
                                Usar ISSUU?
                                <label class="switch switch-success">
                                    <input id="issuu" type="checkbox" value="1" class="form-control" name="issuu_active" {{ old('issuu_active') ? 'checked' : ''}}>
                                    <span></span>
                                </label>

                                @if ($errors->has('issuu_active'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('issuu_active') }}</strong>
                                    </span>
                                @endif
                                @push('scripts')
                                    <script>
                                        @if(old('issuu_active'))
                                        $(window).ready(function() {
                                                $('#issuu').trigger( "click");
                                                $('#issuu').trigger( "click");
                                        });
                                        @endif
                                        $('#issuu').on('change', function() {
                                            if(this.checked) {
                                                $('#issuu_script').fadeIn()
                                                $('.not-issuu').fadeOut();
                                            } else {
                                                $('#issuu_script').fadeOut()
                                                $('.not-issuu').fadeIn();
                                            }
                                        });
                                    </script>
                                @endpush
                            </div>
                            <div class="col-md-4 {{ $errors->has('thumbnail') ? ' has-error' : '' }}">

                                <div class="image-upload {{ $errors->has('thumbnail') ? ' has-error' : '' }}">

                                    <label class="btn btn-primary" for="my-file-selector2">
                                        <input id="my-file-selector2" name="thumbnail" type="file" style="display:none;" onchange="$('#upload-file-info2').html('Portada: ' + $(this).val().replace(/^.*\\/g, ''));">
                                        Subir Imagen Portada
                                    </label>
                                    <p class='label-info' id="upload-file-info2"></p>

                                </div>

                                @if ($errors->has('thumbnail'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('thumbnail') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="not-issuu col-md-4 {{ $errors->has('pdf') ? ' has-error' : '' }}">

                                <div class="image-upload {{ $errors->has('pdf') ? ' has-error' : '' }}">

                                    <label class="btn btn-primary" for="my-file-selector">
                                        <input id="my-file-selector" name="pdf" type="file" style="display:none;" onchange="$('#upload-file-info').html('PDF: ' + $(this).val().replace(/^.*\\/g, ''));">
                                        Subir PDF Revista
                                    </label>
                                    <p class='label-info' id="upload-file-info"></p>

                                </div>

                                @if ($errors->has('pdf'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('pdf') }}</strong>
                                </span>
                                @endif
                            </div>
                            
                            <div class="col-md-12 {{ $errors->has('issuu_script') ? ' has-error' : '' }}" id="issuu_script" style="display:none;">
                                <textarea name="issuu_script" rows="12" cols="90" placeholder="Codigo de ISSUU">{{ old('issuu_script') }}</textarea>
                                @if ($errors->has('issuu_script'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('issuu_script') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class=" not-issuu col-md-12 {{ $errors->has('description') ? ' has-error' : '' }}">
                                @push('scripts')
                                <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
                                <script>
                                    var editor_config = {
                                        path_absolute : "/",
                                        selector: "textarea#article_text",
                                        plugins: [
                                            "autolink lists link hr anchor pagebreak"
                                        ],
                                        toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link",
                                    };

                                    tinymce.init(editor_config);
                                </script>
                                @endpush
                                <textarea id="article_text" type="text" class="form-control" rows="12" name="description" placeholder="Texto">{{ old('description') }}</textarea>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group form-actions">
                        <div class="col-md-3 col-md-offset-9">
                            <button type="submit" class="btn btn-primary float-right"><i class="hi hi-check"></i> Agregar Revista</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection