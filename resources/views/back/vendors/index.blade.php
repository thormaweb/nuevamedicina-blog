@extends('back.master')

@section('content')

    <div id="page-content">

        <!-- Datatables Content -->
        <div class="block full">
            <div class="block-title">
                <h2><strong>Proveedores</strong></h2>
                <div class="block-options pull-right">
                    <a href="{{ route('addVendor') }}" class="btn btn-alt btn-sm btn-success"><i class="gi gi-circle_plus"></i>  Agregar</a>
                </div>
            </div>

            @if(session()->has('flash_message'))
                <div class="alert alert-{{ session()->get('flash_message') }}" role="alert">
                    <strong>{{ session()->get('message_strong') }}</strong> {{ session()->get('message') }}
                </div>
            @endif

            <div class="table-responsive">
                <div class="dataTables_wrapper form-inline no-footer">
                    <table class="table table-vcenter table-condensed table-bordered vendors_list">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                {{--<th>Logo</th>--}}
                                <th>Nombre</th>
                                <th>Web</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($vendors as $vendor)
                                <tr>
                                    <td class="text-center">{{ $vendor->id }}</td>
                                    {{--<td><img src="/photos/vendors/{{ $vendor->logo }}"></td>--}}
                                    <td>{{ $vendor->name }}</td>
                                    <td>{{ $vendor->website }}</td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            @push('scripts')
                                            <script src="{{ url('/back/js/bootstrap-confirmation.min.js') }}"></script>
                                            <script>
                                                jQuery('#quantity select').on('change', function () {
                                                    jQuery('#quantity').submit();
                                                });

                                                jQuery('a.delete-vendor').confirmation({
                                                    title: "Estas seguro?",
                                                    btnOkLabel: "Si",
                                                    btnCancelLabel: "No",
                                                    popout: true,
                                                    onConfirm : function () {
                                                        jQuery('form', this).submit();
                                                    }
                                                });
                                            </script>
                                            @endpush
                                            <a href="{{ route('editVendor', ['id' => $vendor->id]) }}" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
                                            <a data-toggle="tooltip" class="btn btn-xs btn-danger delete-vendor">
                                                <i class="fa fa-times"></i>
                                                <form method="POST" role="form" action="{{ route('deleteVendor', ['id' => $vendor->id]) }}" class="form-horizontal delete-vendor">
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
        </div>
        <!-- END Datatables Content -->
    </div>
    <!-- END Page Content -->
@endsection