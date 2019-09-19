@extends('back.master')

@section('content')

    <div id="page-content">

        <!-- Datatables Content -->
        <div class="block full">
            <div class="block-title">
                <h2><strong>Revistas</strong></h2>
                <div class="block-options pull-right">
                    <a href="{{ route('addMagazine') }}" class="btn btn-alt btn-sm btn-success"><i class="gi gi-circle_plus"></i>  Agregar</a>
                </div>
            </div>

            @if(session()->has('flash_message'))
                <div class="alert alert-{{ session()->get('flash_message') }}" role="alert">
                    <strong>{{ session()->get('message_strong') }}</strong> {{ session()->get('message') }}
                </div>
            @endif


            <div class="table-responsive" id="magazines-index">
                <div class="dataTables_wrapper form-inline no-footer">

                    <table class="table table-vcenter table-condensed table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Imagen</th>
                                <th class="text-center">Edición</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($magazines as $magazine)
                                <tr>
                                    <td class="text-center"><img src="/files/revista/{{ $magazine->thumbnail }}" width="100px"></td>
                                    <td class="text-center"><h4>{{ $magazine->name }}</h4></td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="{{ route('editMagazine', ['id' => $magazine->id]) }}" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
                                            <a data-toggle="tooltip" class="btn btn-xs btn-danger delete-user">
                                                <i class="fa fa-times"></i>
                                                <form method="POST" role="form" action="{{ route('deleteMagazine', ['id' => $magazine->id]) }}" class="form-horizontal delete-user">
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
                            <strong>{{ 1 + ($magazines->currentPage() - 1) * $magazines->perPage() }}</strong>-<strong>{{ $magazines->perPage() + ($magazines->currentPage() - 1) * $magazines->perPage() }}</strong> de <strong>{{ $magazines->total() }}</strong>
                        </div>
                    </div>
                    <div class="col-sm-8 col-xs-12 clearfix">
                        <div class="dataTables_paginate paging_bootstrap">
                            {!!  $magazines->render() !!}
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