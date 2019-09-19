@extends('back.master')

@section('content')

    <div id="page-content">

        <!-- Datatables Content -->
        <div class="block full">
            <div class="block-title">
                <h2><strong>Articulos</strong></h2>
                <div class="block-options pull-right">
                    <a href="{{ route('addArticle') }}" class="btn btn-alt btn-sm btn-success"><i class="gi gi-circle_plus"></i>  Agregar</a>
                </div>
            </div>

            @if(session()->has('flash_message'))
                <div class="alert alert-{{ session()->get('flash_message') }}" role="alert">
                    <strong>{{ session()->get('message_strong') }}</strong> {{ session()->get('message') }}
                </div>
            @endif

            <div class="dataTables_wrapper form-inline no-footer">
                <div class="row">
                    <div class="col-sm-6">
                        @if(Request::has('inactive'))
                            <a href="{{ route('articleBack') }}" class="btn btn-alt btn-sm btn-success"><i class="fa fa-eye"></i>  Ver activos</a>
                        @else
                            <form method="GET">
                                <input type="hidden" name="inactive" value="inactive">
                                <button type="submit" class="btn btn-alt btn-sm btn-success"><i class="fa fa-eye"></i>  Ver Inactivos</button>
                            </form>
                        @endif
                    </div>
                    <div class="col-sm-3">
                        @if(Request::has('q'))
                            Resultado para:  <a href="{{ route('articleBack') }}" class="btn btn-xs btn-default pull-right"><i class="fa fa-times"></i> {{ Request::query('q') }}</a>
                        @endif
                    </div>
                    <div class="col-sm-3">
                        <div class="dataTables_filter">
                            <form method="GET" class="form-horizontal" id="form-simple-search">

                                <div class="form-group {{ $errors->has('q') ? ' has-error' : '' }}">
                                    <div class="input-group">

                                        <input type="search" class="form-control" placeholder="Buscar" name="q">
                                        <span class="input-group-addon" id="span-simple-search">
                                            <i class="fa fa-search"></i>
                                        </span>

                                        @push('scripts')
                                        <script>
                                            jQuery('#span-simple-search').on('click', function() {
                                                jQuery('#form-simple-search').submit();
                                            });
                                        </script>
                                        @endpush
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive" id="articles-index">
                <div class="dataTables_wrapper form-inline no-footer">

                    <table class="table table-vcenter table-condensed table-bordered">
                        <thead>
                        <tr>
                            <th class="text-center">Articulo</th>
                            <th class="text-center">Categoria</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($articles as $article)
                            <tr>
                                <td class="text-center">{{ $article->name }}</td>
                                <td class="text-center">{{ $article->category()->first()->name }}</td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        @if(! Request::has('inactive'))
                                        <a href="{{ route('article', [$article->category->slug, $article->slug]) }}" target="_blank" class="btn btn-xs btn-default"><i class="fa fa-eye"></i></a>
                                        @endif
                                        <a href="{{ route('editArticle', ['id' => $article->id]) }}" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
                                        <a data-toggle="tooltip" class="btn btn-xs btn-danger delete-user">
                                            <i class="fa fa-times"></i>
                                            <form method="POST" role="form" action="{{ route('deleteArticle', ['id' => $article->id]) }}" class="form-horizontal delete-user">
                                                {!! csrf_field() !!}
                                            </form>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

            <div class="dataTables_wrapper form-inline no-footer">
                <div class="row">
                    <div class="col-sm-4 hidden-xs">
                        <div class="dataTables_info" id="example-datatable_info" role="status" aria-live="polite">
                            <strong>{{ 1 + ($articles->currentPage() - 1) * $articles->perPage() }}</strong>-<strong>{{ $articles->perPage() + ($articles->currentPage() - 1) * $articles->perPage() }}</strong> de <strong>{{ $articles->total() }}</strong>
                        </div>
                    </div>
                    <div class="col-sm-8 col-xs-12 clearfix">
                        <div class="dataTables_paginate paging_bootstrap">
                            {!!  $articles->render() !!}
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- END Datatables Content -->
    </div>
    <!-- END Page Content -->
@endsection

@push('scripts')

<script src="{{ url('/back/js/bootstrap-confirmation.min.js') }}"></script>

<script>
    jQuery('#quantity select').on('change', function () {
        jQuery('#quantity').submit();
    });

    jQuery('a.delete-user').confirmation({
        title: "Estas seguro/a?",
        btnOkLabel: "Si",
        btnCancelLabel: "No",
        popout: true,
        onConfirm : function () {
            jQuery('form', this).submit();
        }
    });

    $('tbody tr').each(function ( index, element ) {

        $(element).find('td:nth-child(1)').height($(element).find('td:nth-child(2)').height());
    });


</script>

@endpush