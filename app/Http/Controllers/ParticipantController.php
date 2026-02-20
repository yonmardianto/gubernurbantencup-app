<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Setting;
use App\Models\User;
use App\Traits\FileUpload;
use Auth;
use Illuminate\Http\Request;
use OpenSpout\Common\Entity\Style\Style;
use Rap2hpoutre\FastExcel\FastExcel;
use Redirect;

class ParticipantController extends Controller
{
    use FileUpload;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $user = Auth::user();

        if (Auth::guard('admin')->check()) {

            $participants = Participant::orderby('id', 'desc')->get();

            return view('admin.participants.index', compact('participants'));
        } else {
            $participants = Participant::where('manager_id', $user->id)->orderby('created_at', 'desc')->get();

            $lock = filter_var(Setting::where('key', 'lock application')->value('value'), FILTER_VALIDATE_BOOLEAN);

            return view('frontend.manager-dashboard.participants.index', compact('participants', 'lock'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $user = Auth::user();
        $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Participant::class],
            'gender' => ['required'],
            'tgl_lahir' => ['required'],
            // 'no_hp'=> ['required'],
            'club' => ['required'],
            'kategori' => ['required'],
        ]);

        if ($request->file('foto')) {
            $request->validate(['foto' => ['mimes:jpg,jpeg,png', 'max:1024']]); // max file 1MB
        }

        $participant = Participant::create([
            'nama_lengkap' => $request->nama_lengkap,
            'tgl_lahir' => date('Y-m-d', strtotime($request->tgl_lahir)),
            'gender' => $request->gender,
            'club' => $request->club,
            'kategori' => $request->kategori,
            'kategori_level' => $request->kategori_level,
            'kategori_tanding' => $request->kategori_tanding,
            'kelompok_poomsae' => $request->kelompok_poomsae,
            'sabuk_poomsae' => $request->sabuk_poomsae ?? null,
            'sabuk_kyorugi' => $request->sabuk_kyorugi ?? null,
            // 'kategori_usia' => $request->kategori_usia,
            'berat_badan' => $request->berat_badan,
            'tinggi_badan' => $request->tinggi_badan ?? null,
            'manager_id' => $user->id,

        ]);

        if ($request->file('foto')) {
            $this->uploadFile($request->file('foto'), 'foto-peserta', 'foto_', $participant);
        }

        return Redirect::route('manager-team.dashboard')->with('success', 'Data entry name anda berhasil disubmit');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $participant = Participant::findOrFail($id);

        return view('admin.participants.show', compact('participant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $participant = Participant::findOrFail($id);
        $documents = $participant->documents()->get();

        // dd($participant->documents()->get());
        return view('frontend.manager-dashboard.participants.edit', compact('participant', 'documents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::user();

        $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'tgl_lahir' => ['required'],
            'gender' => ['required'],
            'club' => ['required'],
            'kategori' => ['required'],
        ]);

        if ($request->file('foto')) {
            $request->validate(['foto' => ['mimes:jpg,jpeg,png', 'max:1024']]); // max file 1MB
        }

        $participant = Participant::findOrFail($id);
        $participant->nama_lengkap = $request->nama_lengkap;
        $participant->tgl_lahir = date('Y-m-d', strtotime($request->tgl_lahir));
        $participant->gender = $request->gender;
        $participant->club = $request->club;
        $participant->kategori = $request->kategori;
        $participant->kategori_level = $request->kategori_level;
        $participant->kategori_tanding = $request->kategori_tanding;
        $participant->kelompok_poomsae = $request->kelompok_poomsae;
        $participant->sabuk_poomsae = $request->sabuk_poomsae ?? null;
        $participant->sabuk_kyorugi = $request->sabuk_kyorugi ?? null;
        // $participant->kategori_usia = $request->kategori_usia;
        $participant->berat_badan = $request->berat_badan ?? null;
        $participant->tinggi_badan = $request->tinggi_badan ?? null;
        $participant->manager_id = $user->id;
        $participant->update();

        if ($request->file('foto')) {

            // Check exist foto ? delete it
            $documents = $participant->documents()->get();
            if (count($documents) > 0) {
                foreach ($documents as $item) {
                    // delete storage
                    $this->removeFile($item->path);
                }
            }

            // delete file on documents table
            $participant->documents()->delete();

            // Upload new foto
            $this->uploadFile($request->file('foto'), 'foto-peserta', 'foto_', $participant);
        }

        return Redirect::route('manager-team.participants.index')->with('success', 'Data entry name anda berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $participant = Participant::findOrFail($id);

        // Check exist foto ? delete it
        $documents = $participant->documents()->get();
        if (count($documents) > 0) {
            foreach ($documents as $item) {
                // delete storage
                $this->removeFile($item->path);
            }
        }

        // delete file on documents table
        $participant->documents()->delete();

        // delete
        $participant->delete();

        return Redirect::route('manager-team.participants.index')->with('success', 'Data peserta berhasil dihapus');
    }

    public function getDataParticipants(Request $request)
    {

        // Page Length
        $pageNumber = ($request->start / $request->length) + 1;
        $pageLength = $request->length;
        $skip = ($pageNumber - 1) * $pageLength;

        // Page Order
        $orderColumnIndex = $request->order[0]['column'] ?? '0';
        $orderBy = $request->order[0]['dir'] ?? 'desc';

        $query = \DB::table('participants')->select('*');

        // Search
        // $search = $request->search;
        // $query = $query->where(function($query) use ($search){
        //     $query->orWhere('nama_lengkap', 'like', "%".$search."%");
        //     $query->orWhere('gender', 'like', "%".$search."%");
        //     $query->orWhere('club', 'like', "%".$search."%");
        //     $query->orWhere('kategori', 'like', "%".$search."%");
        //     $query->orWhere('kategori_tanding', 'like', "%".$search."%");
        //     $query->orWhere('kelompok_poomsae', 'like', "%".$search."%");
        //     $query->orWhere('berat_badan', 'like', "%".$search."%");
        // });

        // Search Custom Filter
        $filter_data = json_decode($request->customFilter);
        $query = $query->where(function ($query) use ($filter_data) {

            if (isset($filter_data->filter_nama_lengkap) && ! empty($filter_data->filter_nama_lengkap)) {
                $query->orWhere('nama_lengkap', 'like', '%'.trim($filter_data->filter_nama_lengkap).'%');
                $query->orWhere('club', 'like', '%'.trim($filter_data->filter_nama_lengkap).'%');
            }

            if (isset($filter_data->filter_gender) && ! empty($filter_data->filter_gender)) {
                $query->whereIn('gender', $filter_data->filter_gender);
            }

            if (isset($filter_data->filter_kategori) && ! empty($filter_data->filter_kategori)) {
                $query->whereIn('kategori', $filter_data->filter_kategori);
            }

            if (isset($filter_data->filter_level) && ! empty($filter_data->filter_level)) {
                $query->whereIn('kategori_level', $filter_data->filter_level);
            }

            if (isset($filter_data->filter_kategori_tanding) && ! empty($filter_data->filter_kategori_tanding)) {
                $query->whereIn('kategori_tanding', $filter_data->filter_kategori_tanding);
            }
        });

        $orderByName = 'created_at';
        switch ($orderColumnIndex) {
            case '1':
                $orderByName = 'nama_lengkap';
                break;

            case '8':
                $orderByName = 'created_at';
                break;
        }

        $query = $query->orderBy($orderByName, $orderBy);
        $recordsFiltered = $recordsTotal = $query->count();
        $participants = $query->skip($skip)->take($pageLength)->get();

        return response()->json(['draw' => $request->draw, 'recordsTotal' => $recordsTotal, 'recordsFiltered' => $recordsFiltered, 'data' => $participants], 200);
    }

    public function downloadParticipants(Request $request)
    {

        $query = \DB::table('participants')->select('*');

        $query = $query->where(function ($query) use ($request) {

            if (isset($request->filter_nama_lengkap) && ! empty($request->filter_nama_lengkap)) {
                $query->where('nama_lengkap', 'like', '%'.$filter_data->filter_nama_lengkap.'%');
            }

            if (isset($request->filter_gender) && ! empty($request->filter_gender)) {
                $query->whereIn('gender', [$request->filter_gender]);
            }

            if (isset($request->filter_kategori) && ! empty($request->filter_kategori)) {
                $query->whereIn('kategori', [$request->filter_kategori]);
            }

            if (isset($request->filter_level) && ! empty($request->filter_level)) {
                $query->whereIn('kategori_level', [$request->filter_level]);
            }

            if (isset($request->filter_kategori_tanding) && ! empty($request->filter_kategori_tanding)) {
                $query->whereIn('kategori_tanding', [$request->filter_kategori_tanding]);
            }
        });

        $participants = $query->orderby('created_at', 'desc')->get();
        $header_style = (new Style)
            ->setFontBold()
            ->setBackgroundColor('EDEDED');

        $rows_style = (new Style)
            ->setFontSize(12);

        return (new FastExcel($participants))
            ->headerStyle($header_style)
            ->rowsStyle($rows_style)
            ->download('peserta-'.date('YmdHis').'.xlsx', function ($item) {
                return [
                    'Nama Lengkap' => $item->nama_lengkap,
                    'Gender' => $item->gender,
                    'Tanggal Lahir' => $item->tgl_lahir,
                    'Kategori' => $item->kategori,
                    'Kategori Level' => str_replace('_', ' ', $item->kategori_level),
                    'Kategori Tanding' => $item->kategori_tanding,
                    'Keterangan' => $item->kategori_tanding === 'KYORUGI' ? $item->berat_badan : $item->kelompok_poomsae,
                    'Club/Team' => $item->club,
                ];
            });
    }

    public function getUserParticipants(string $user_id)
    {

        $participants = Participant::where('manager_id', $user_id)->get();
        $manager = User::where('id', $user_id)->first();

        return view('admin.clubs.participants.show', compact('participants', 'manager'));

    }
}
