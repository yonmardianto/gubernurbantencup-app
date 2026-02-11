@extends('admin.layouts.master')

@section('title')
    Admin - Show Bukti Transfer
    @parent
@stop


@section('header_styles')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/datatables.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/venobox.min.css') }}">
@stop


@section('content')

    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">

                    <h2 class="page-title">
                        Bukti Transfer
                    </h2>
                </div>

            </div>
        </div>
    </div>


    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">

                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-status-top bg-info"></div>
                        <div class="card-body text-center">
                            <div class="card-title mb-1">{{ $manager->name }}</div>

                            <div class="text-secondary">
                                {{ $manager->club }} </div>
                            <div class="text-secondary">
                                {{ $manager->no_hp }} </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-9">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title">
                                Bukti Transfer
                            </h3>
                            <div class="card-actions">
                                <a href="{{ route('admin.clubs.index') }}" class="btn btn-light btn-sm rounded">
                                    <span>&#8592;</span>
                                    Back </a>
                            </div>

                        </div>
                        <div class="card-body table-responsive-lg table-responsive-sm table-responsive-md">

                            <table id="tbl_payments" class="table table-bordered table-striped table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Tanggal Upload</th>
                                        <th>Bukti Transfer</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse ($payments as $item)
                                        <tr>
                                            <td>{{ $item->created_at }}</td>
                                            <td> <a class="venobox" href="{{ url('/' . $item->documents[0]->path) }}"> <img
                                                        src="{{ url('/' . $item->documents[0]->path) }}" class="mt-3"
                                                        style="width: 50px !important; height: 50px !important;" /> </a></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8">Data tidak ditemukan </td>
                                        </tr>
                                    @endforelse


                                </tbody>

                            </table>

                        </div>
                    </div>
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
