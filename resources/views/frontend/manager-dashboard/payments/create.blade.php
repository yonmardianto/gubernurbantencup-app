@extends('frontend.layouts.dashboard')

@section('title')
    Create Payment
    @parent
@stop


@section('content')
    <form name="form-pembayaran" method="post" enctype="multipart/form-data"
        action="{{ route('manager-team.payments.store') }}">
        @csrf
        <div class="row">
            <div class="col-xl-12 col-sm-12 wow fadeInUp">

                <div class="wsus__dash_earning">

                    <h6 class="mb-5"><strong>Upload Bukti Transfer</strong></h6>

                    <x-auth-session-status class="mb-4" :status="session('success')" />

                    <div class="row">


                        <div class="col-xl-12">
                            <div class="required  mb-2">
                                <label for="email" class="form-label">Club </label>
                                <input class="form-control form-control-sm" name="club" id="club" type="text"
                                    placeholder="Club" value="{{ auth()->user()->club }}" readonly
                                    style="background-color: #dfe6e9; !important;">
                                <x-input-error :messages="$errors->get('club')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-xl-12">
                            <div class="required mb-2">
                                <label for="description" class="form-label">Deskripsi</label>
                                <textarea name="description" class="form-control form-control-sm" rows="10">{{ old('description') }}</textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>
                        </div>


                        <div class="col-xl-12">
                            <div class="required mb-2">
                                <label for="file"> Upload Bukti Pembayaran </label>
                                <input type="file" name="file" id="file" class="form-control form-control-sm"
                                    accept="image/*" />
                                <x-input-error :messages="$errors->get('file')" class="mt-2" />
                            </div>
                        </div>


                        <div class="col-lg-12">
                            <div class="wsus__login_form_input">
                                <button type="submit" class="btn btn-primary text-white rounded-md"><i
                                        class="fas fa-save"></i>
                                    Submit
                                </button>
                            </div>


                        </div>
                    </div>

                </div>
            </div>


        </div>


    </form>

@stop
