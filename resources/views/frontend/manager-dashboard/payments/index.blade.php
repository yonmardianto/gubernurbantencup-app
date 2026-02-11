@extends('frontend.layouts.dashboard')

@section('title')
    Bukti Transfer
    @parent
@stop

@section('header_styles')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/datatables.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/venobox.min.css') }}">
@stop

@section('content')

    <div class="row">
        <div class="col-xl-12 col-sm-12 wow fadeInUp">
            <div class="wsus__dash_earning">
                <h6 class="mb-5"><strong>Bukti Transfer</strong></h6>

                <x-auth-session-status class="mb-4" :status="session('success')" />
                <div class="row">

                    <div class="card-header bg-primary p-2">
                        <div class="float-end">
                            @if(!$lock)
                                <a href="{{ route('manager-team.payments.create') }}" class="btn btn-light btn-sm rounded">
                                    <i class="fa fa-plus"></i> Create </a>
                            @endif    
                        </div>
                    </div>

                    <div class="card-body table-responsive-lg table-responsive-sm table-responsive-md">
                        <table id="tbl_payments" class="table table-bordered table-striped table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Tanggal Upload</th>
                                    <th>Club</th>
                                    <th>Bukti Transfer</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($payments as $item)
                                    <tr>
                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ $item->club }}</td>
                                        <td> <a class="venobox" href="{{ url('/' . $item->documents[0]->path) }}"> <img
                                                    src="{{ url('/' . $item->documents[0]->path) }}" class="mt-3"
                                                    style="width: 50px !important; height: 50px !important;" /> </a></td>
                                        <td>
                                            <a href="javascript:;"
                                                onclick="if(confirm('Apakah anda yakin akan menghapus data ini ?')) $('.form-{{ $item->id }}').submit();"
                                                style="color: #ff0000;" class="ms-1 me-1" role="button"><i
                                                    class="fas fa-trash-alt"></i></a>
                                            <form method="post"
                                                action="{{ route('manager-team.payments.destroy', $item->id) }}"
                                                class="form-{{ $item->id }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8">Data tidak ditemukan </td>
                                    </tr>
                                @endforelse


                            </tbody>

                        </table>

                        </card>

                    </div>

                </div>

            </div>

        </div>

    @stop
    @section('footer_scripts')
        <script type="text/javascript" src="{{ asset('frontend/assets/js/datatables/datatables.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('frontend/assets/js/venobox.min.js') }}"></script>
        <script type="text/javascript">
            const dataPayments = {{ count($payments) }};

            if (dataPayments > 0) {
                new DataTable('#tbl_payments', {
                    order: [
                        [0, 'desc']
                    ],

                });

                $('.venobox').venobox();
            }
        </script>


    @stop
