@extends('back.master')

@section('content')

    <div id="page-content" class="forms">
        <div class="row">

            <div class="block">

                <div class="block-title">
                    <h2><strong>Agregar</strong> Articulo</h2>
                </div>

                <form action="{{ route('addArticle') }}" class="form-horizontal form-bordered" method="POST" enctype="multipart/form-data">

                    {!! csrf_field() !!}

                    <div class="form-group">
                        <label class="col-md-2 control-label"><legend><i class="fa fa-bookmark fa-fw"></i> General</legend></label>
                        <div class="col-md-10">
                            <div class="col-md-3">
                                Habilitado
                                <label class="switch switch-success">
                                    <input type="checkbox" value="1" class="form-control" name="enable" {{ old('enable') ? 'checked' : ''}}>
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
                            <div class="col-md-6 {{ $errors->has('image') ? ' has-error' : '' }}">

                                <div class="image-upload {{ $errors->has('image') ? ' has-error' : '' }}">

                                    <label class="btn btn-primary" for="my-file-selector">
                                        <input id="my-file-selector" name="image" type="file" style="display:none;" onchange="$('#upload-file-info').html('Nueva imagen: ' + $(this).val().replace(/^.*\\/g, ''));">
                                        Imagen destacada
                                    </label>
                                    <span class='label label-info' id="upload-file-info"></span>

                                </div>

                                @if ($errors->has('image'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="col-md-12 {{ $errors->has('name') ? ' has-error' : '' }}">
                                <input type="text" class="form-control" name="name" placeholder="Nombre del articulo" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 {{ $errors->has('category_id') ? ' has-error' : '' }}">
                                <select name="category_id" class="form-control select-select2" data-placeholder="Categoria">

                                    <option></option>

                                    @inject('categories', 'App\ArticleCategory')

                                    @foreach($categories->ordered()->get() as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('category_id'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('category_id') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-12 {{ $errors->has('text') ? ' has-error' : '' }}">
                                @push('scripts')
                                <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
                                <script>
                                    var editor_config = {
                                        path_absolute : "/",
                                        selector: "textarea#article_text",
                                        plugins: [
                                            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                                            "searchreplace wordcount visualblocks visualchars code fullscreen",
                                            "insertdatetime media nonbreaking save table contextmenu directionality",
                                            "emoticons template paste textcolor colorpicker textpattern"
                                        ],
                                        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
                                        relative_urls: false,
                                        file_browser_callback : function(field_name, url, type, win) {
                                            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                                            var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                                            var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                                            if (type == 'image') {
                                                cmsURL = cmsURL + "&type=Images";
                                            } else {
                                                cmsURL = cmsURL + "&type=Files";
                                            }

                                            tinyMCE.activeEditor.windowManager.open({
                                                file : cmsURL,
                                                title : 'Filemanager',
                                                width : x * 0.8,
                                                height : y * 0.8,
                                                resizable : "yes",
                                                close_previous : "no"
                                            });
                                        }
                                    };

                                    tinymce.init(editor_config);
                                </script>
                                @endpush
                                <textarea id="article_text" type="text" class="form-control" rows="12" name="text" placeholder="Texto">{{ old('text') }}</textarea>

                                @if ($errors->has('text'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('text') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group form-actions">
                        <div class="col-md-3 col-md-offset-9">
                            <button type="submit" class="btn btn-primary float-right"><i class="hi hi-check"></i> Agregar Articulo</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection