<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateClubRequest;
use App\Models\Participant;
use App\Models\Setting;
use App\Traits\FileUpload;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Redirect;

class FrontendController extends Controller
{
    use FileUpload;

    public function index()
    {
        $lock = filter_var(Setting::where('key', 'lock application')->value('value'), FILTER_VALIDATE_BOOLEAN);

        return view('frontend.pages.home.index', compact('lock'));
    }

    public function registrasi()
    {
        return view('frontend.pages.home.registrasi');
    }

    public function store(Request $request)
    {

        $user = Auth::user();

        $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Participant::class],
            'gender' => ['required'],
            'no_hp' => ['required'],
            'club' => ['required'],
            'kategori' => ['required'],
        ]);

        if ($request->file('pembayaran')) {
            $request->validate(['pembayaran' => ['mimes:jpg,jpeg,png', 'max:1024']]); // max file 1MB
        }

        $user = Participant::create([
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'gender' => $request->gender,
            'club' => $request->club,
            'kategori' => $request->kategori,
            'kategori_level' => $request->kategori_level,
            'kategori_tanding' => $request->kategori_tanding,
            'kelompok_poomsae' => $request->kelompok_poomsae,
            'sabuk_poomsae' => $request->sabuk_poomsae,
            'kategori_usia' => $request->kategori_usia,
            'berat_badan' => $request->berat_badan,
            'pembayaran' => ($request->file('pembayaran')) ? $this->uploadFile($request->file('pembayaran'), 'uploads', 'pembayaran_') : null,
            'manager_id' => $user->id,

        ]);

        return Redirect::route('manager-team.dashboard')->with('success', 'Data entry name anda berhasil disubmit');

    }

    public function updateClub(UpdateClubRequest $request)
    {
        $user = Auth::user();
        $oldClub = $user->club;
        $newClub = $request->club;

        DB::transaction(function () use ($user, $oldClub, $newClub) {
            // 1. Update the user's club
            $user->update(['club' => $newClub]);

            // 2. Cascade to all participants registered under this manager
            //    that still carry the old club name
            Participant::where('manager_id', $user->id)
                ->where('club', $oldClub)
                ->update(['club' => $newClub]);
        });

        // 3. Activity log
        Log::info('Club name updated', [
            'user_id' => $user->id,
            'user_name' => $user->name,
            'old_club' => $oldClub,
            'new_club' => $newClub,
            'ip' => $request->ip(),
            'at' => now()->toDateTimeString(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Nama club berhasil diperbarui.',
            'new_club' => $newClub,
        ]);
    }
}
