@extends('frontend.layouts.dashboard')

@section('title')
    Peserta
    @parent
@stop
@section('header_styles')
 <link rel="stylesheet" href="{{ asset('frontend/assets/css/datatables.min.css') }}" />
@stop

@section('content')

    <div class="row">
        <div class="col-xl-12 col-sm-12 wow fadeInUp">
            <div class="wsus__dash_earning">
                <h6 class="mb-5"><strong>Peserta</strong></h6>

                <x-auth-session-status class="mb-4" :status="session('success')" />
                <div class="row">

                    <div class="card-body table-responsive-lg table-responsive-sm table-responsive-md">
                        <table id="tbl_peserta" class="table table-bordered table-striped table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Gender</th>
                                    <th>Kategori</th>
                                    <th>Level</th>
                                    <th>Kategori Tanding</th>
                                    <th>Keterangan</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($participants as $item)
                                    <tr>
                                        <td>{{ $item->nama_lengkap }}</td>
                                        <td>{{ $item->gender }}</td>
                                        <td>{{ $item->kategori }}</td>
                                        <td>{{ str_replace('_',' ', $item->kategori_level) }}</td>
                                        <td>{{ $item->kategori_tanding }}</td>
                                        <td>{{ $item->kategori_tanding === 'KYORUGI' ? $item->berat_badan : $item->kelompok_poomsae }}
                                        </td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            @if(!$lock)
                                                <a href="{{ route('manager-team.participants.edit', $item->id) }}"><i
                                                        class="fa fa-edit"></i> </a>
                                                <a href="javascript:;"
                                                    onclick="if(confirm('Apakah anda yakin akan menghapus data ini ?')) $('.form-{{ $item->id }}').submit();"
                                                    style="color: #ff0000;" class="ms-1 me-1" role="button"><i
                                                        class="fas fa-trash-alt"></i></a>
                                                <form method="post"
                                                    action="{{ route('manager-team.participants.destroy', $item->id) }}"
                                                    class="form-{{ $item->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>

                                            @endif

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
        <script type="text/javascript">
            $(document).ready(function() {

                const dataParticipants = {{ count($participants) }};

                if (dataParticipants > 0) {
                    new DataTable('#tbl_peserta', {
                        order: [
                            [6, 'desc']
                        ],
                        dom: 'Bflrtip',
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
                                    return 'Daftar Peserta ';
                                },
                            }

                        ]

                    });

                }
            });
        </script>


    @stop
