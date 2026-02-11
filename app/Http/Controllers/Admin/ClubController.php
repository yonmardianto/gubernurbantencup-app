<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClubController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.clubs.index');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getDataClubs(Request $request)
    {
        // Page Length
        $pageNumber = ($request->start / $request->length) + 1;
        $pageLength = $request->length;
        $skip       = ($pageNumber - 1) * $pageLength;


        // Page Order
        $orderColumnIndex = $request->order[0]['column'] ?? '0';
        $orderBy = $request->order[0]['dir'] ?? 'desc';


        $query = DB::table('users')->selectRaw('users.id, users.club, `name`, users.created_at,  users.no_hp, COUNT(participants.id) AS jml_peserta');
        $query->leftjoin('participants', 'users.id', 'participants.manager_id');


        // Search
        $search = $request->search;
        $query = $query->where(function ($query) use ($search) {
            $query->orWhere('users.club', 'like', "%" . $search . "%");
            $query->orWhere('users.name', 'like', "%" . $search . "%");
            $query->orWhere('users.no_hp', 'like', "%" . $search . "%");
        });


        $orderByName = 'users.created_at';
        switch ($orderColumnIndex) {
            case '1':
                $orderByName = 'users.club';
                break;

            case '2':
                $orderByName = 'users.name';
                break;

            case '3':
                $orderByName = 'users.no_hp';
                break;
            case '5':
                $orderByName = 'users.created_at';
                break;
        }

        $query = $query->groupBy('users.id', 'users.club', 'users.name', 'users.no_hp', 'users.created_at')->orderBy($orderByName, $orderBy);
        $recordsFiltered = $recordsTotal = $query->get()->count();
        $clubs = $query->skip($skip)->take($pageLength)->get();

        return response()->json(["draw" => $request->draw, "recordsTotal" => $recordsTotal, "recordsFiltered" => $recordsFiltered, 'data' => $clubs], 200);
    }
}
