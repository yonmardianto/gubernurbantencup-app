<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.users.index');
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
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'password'=> 'required|min:8|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'min:8',
        ]);

        $user = User::findOrFail($id);

        if($request->password){
            $user->password = Hash::make($request->password);
            $user->update();
        }

        return redirect()->route('admin.users.index')->with('success', 'Password has been changed successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function getDataUsers(Request $request)
    {
        // Page Length
        $pageNumber = ($request->start / $request->length) + 1;
        $pageLength = $request->length;
        $skip       = ($pageNumber - 1) * $pageLength;


        // Page Order
        $orderColumnIndex = $request->order[0]['column'] ?? '0';
        $orderBy = $request->order[0]['dir'] ?? 'desc';

        $query = DB::table('users')->select('id', 'name', 'email', 'no_hp', 'club', 'created_at');

        // Search
        $search = $request->search;
        $query = $query->where(function ($query) use ($search) {
            $query->orWhere('email', 'like', "%" . $search . "%");
            $query->orWhere('name', 'like', "%" . $search . "%");
            $query->orWhere('club', 'like', "%" . $search . "%");
        });


        $orderByName = 'created_at';
        switch ($orderColumnIndex) {
            case '1':
                $orderByName = 'name';
                break;

            case '2':
                $orderByName = 'email';
                break;

            case '3':
                $orderByName = 'no_hp';
                break;
            case '4':
                $orderByName = 'club';
                break;
        }

        $query = $query->orderBy($orderByName, $orderBy);
        $recordsFiltered = $recordsTotal = $query->get()->count();
        $users = $query->skip($skip)->take($pageLength)->get();

        return response()->json(["draw" => $request->draw, "recordsTotal" => $recordsTotal, "recordsFiltered" => $recordsFiltered, 'data' => $users], 200);
    }
}
