@extends('admin.layouts.master')

@section('title')
    Admin - Detil Peserta
    @parent
@stop

@section('header_styles')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/datatables.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/select2.min.css') }}">
@stop


@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">

                    <h2 class="page-title">
                        Detil Peserta
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
                        <div class="card-body text-center">
                            <div class="mb-3">
                                @if (isset($participant) && !empty($participant->documents[0]->path))
                                    <span class="avatar avatar-xl rounded"
                                        style="background-image: url('{{ asset($participant->documents[0]->path) }}');"></span>
                                @else
                                    <span class="avatar avatar-xl rounded" style="background-image: url('');"></span>
                                @endif
                            </div>
                            <div class="card-title mb-1">{{ $participant->nama_lengkap }}</div>
                            <div class="text-secondary">
                                {{ \Carbon\Carbon::parse($participant->tgl_lahir)->format('d-m-Y') }} </div>
                        </div>
                        <a href="#" class="card-btn">{{ $participant->club }}</a>
                    </div>
                </div>

                <div class="col-md-6 col-xl-9">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title">
                                Profil
                            </h3>
                            <div class="card-actions">
                                <a href="{{ route('admin.participants.index') }}" class="btn btn-light btn-sm rounded">
                                    <span>&#8592;</span>
 Back </a>
                            </div>

                        </div>
                        <div class="card-body">
                            <dl class="row">
                                <dt class="col-5">Gender:</dt>
                                <dd class="col-7">{{ $participant->gender }}</dd>
                                <dt class="col-5">Kategori:</dt>
                                <dd class="col-7">{{ $participant->kategori }}</dd>
                                <dt class="col-5">Kategori Level:</dt>
                                <dd class="col-7">{{ str_replace('_',' ', $participant->kategori_level) }}</dd>
                                <dt class="col-5">Kategori Tanding:</dt>
                                <dd class="col-7">{{ $participant->kategori_tanding }}</dd>
                                <dt class="col-5">Keterangan:</dt>
                                <dd class="col-7">
                                    {{ $participant->kategori_tanding === 'KYORUGI' ? $participant->berat_badan : $participant->kelompok_poomsae }}
                                </dd>
                                <dt class="col-5">Manager:</dt>
                                <dd class="col-7">{{ $participant->manager->name }}</dd>
                                <dt class="col-5">No Hp Manager:</dt>
                                <dd class="col-7">{{ $participant->manager->no_hp }}</dd>

                            </dl>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

@stop
