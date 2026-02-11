<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\FileUpload;

use App\Models\Participant;

use Auth;
use Redirect;

class FrontendController extends Controller
{
    use FileUpload;

    function index() {
        return view('frontend.pages.home.index');
    }

    function registrasi(){
        return view('frontend.pages.home.registrasi');
    }

    function store(Request $request){

        $user = Auth::user();

        $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Participant::class],
            'gender'=> ['required'],
            'no_hp'=> ['required'],
            'club'=> ['required'],
            'kategori'=> ['required']
        ]);


        if($request->file('pembayaran')){
            $request->validate(['pembayaran'=>['mimes:jpg,jpeg,png', 'max:1024']]); //max file 1MB
        }

        $user = Participant::create([
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'gender'=> $request->gender,
            'club'=> $request->club,
            'kategori'=> $request->kategori,
            'kategori_level'=> $request->kategori_level,
            'kategori_tanding'=> $request->kategori_tanding,
            'kelompok_poomsae'=> $request->kelompok_poomsae,
            'sabuk_poomsae'=> $request->sabuk_poomsae,
            'kategori_usia'=> $request->kategori_usia,
            'berat_badan'=> $request->berat_badan,
            'pembayaran'=> ($request->file('pembayaran')) ? $this->uploadFile($request->file('pembayaran'), 'uploads', 'pembayaran_') : null,
            'manager_id'=> $user->id

        ]);
        return Redirect::route('manager-team.dashboard')->with('success', 'Data entry name anda berhasil disubmit');

    }
}
