@extends('admin.layouts.master')

@section('title')
    Admin - Show Peserta
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
                        Peserta
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
                                Peserta
                            </h3>
                            <div class="card-actions">
                                <a href="{{ route('admin.clubs.index') }}" class="btn btn-light btn-sm rounded">
                                    <span>&#8592;</span>
                                    Back </a>
                            </div>

                        </div>
                        <div class="card-body table-responsive-lg table-responsive-sm table-responsive-md">
                            <table id="tbl_peserta" class="table table-bordered table-striped table-hover"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Gender</th>
                                        <th>Kategori</th>
                                        <th>Level</th>
                                        <th>Kategori Tanding</th>
                                        <th>Keterangan</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse ($participants as $item)
                                        <tr>
                                            <td>{{ $item->nama_lengkap }}</td>
                                            <td>{{ $item->gender }}</td>
                                            <td>{{ $item->kategori }}</td>
                                            <td>{{ str_replace('_',' ',$item->kategori_level) }}</td>
                                            <td>{{ $item->kategori_tanding }}</td>
                                            <td>{{ $item->kategori_tanding === 'KYORUGI' ? $item->berat_badan : $item->kelompok_poomsae }}
                                            </td>
                                            <td>{{ $item->created_at }}</td>
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

        </div>

    </div>

@stop

@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('frontend/assets/js/datatables/datatables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/assets/js/venobox.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            const dataParticipants = {{ count($participants) }};
            const namaClub = `{{ $manager->club }}`;

            if (dataParticipants > 0) {
                new DataTable('#tbl_peserta', {
                    order: [
                        [6, 'desc']
                    ],
                    dom: 'Bflrtip',
                    pageLength: 100,
                    buttons: [{
                                extend: 'excelHtml5',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5, 6],
                                    modifier: {
                                        page: 'all',
                                        selected: false
                                    },
                                },
                                text: 'Download',
                                filename: function() {
                                    // return 'Daftar Peserta';
                                    return `Daftar Peserta - ${namaClub}`;
                                },
                            }

                        ]

                });

            }
        });
    </script>


@stop
