<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.admins.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdminRequest $request)
    {
        Admin::create($request->validated());

        return redirect()->route('admin.admins.index')
            ->with('success', 'Admin berhasil ditambahkan.');
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
    public function edit(Admin $admin)
    {
        return view('admin.admins.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        $data = $request->validated();

        // Only include password if it was provided
        if (empty($data['password'])) {
            unset($data['password']);
        }

        $admin->update($data);

        return redirect()->route('admin.admins.index')
            ->with('success', 'Admin berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        // Prevent deletion of the currently logged-in admin
        if (auth('admin')->id() === $admin->id) {
            return redirect()->route('admin.admins.index')
                ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $admin->delete();

        return redirect()->route('admin.admins.index')
            ->with('success', 'Admin berhasil dihapus.');
    }

    /**
     * Get admin data for DataTables.
     */
    public function getDataAdmins(Request $request)
    {
        // Page Length
        $pageNumber = ($request->start / $request->length) + 1;
        $pageLength = $request->length;
        $skip       = ($pageNumber - 1) * $pageLength;

        // Page Order
        $orderColumnIndex = $request->order[0]['column'] ?? '0';
        $orderBy = $request->order[0]['dir'] ?? 'desc';

        $query = Admin::query();

        // Search
        $search = $request->search['value'] ?? $request->search;
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Order
        $orderByName = 'created_at';
        switch ($orderColumnIndex) {
            case '0':
                $orderByName = 'id';
                break;
            case '1':
                $orderByName = 'name';
                break;
            case '2':
                $orderByName = 'email';
                break;
            case '3':
                $orderByName = 'created_at';
                break;
        }

        $query = $query->orderBy($orderByName, $orderBy);
        $recordsTotal = Admin::count();
        $recordsFiltered = $query->count();
        $admins = $query->skip($skip)->take($pageLength)->get();

        // Format data for DataTables
        $data = $admins->map(function ($admin) {
            return [
                'id' => $admin->id,
                'name' => $admin->name,
                'email' => $admin->email,
                'role' => $admin->role,
                'created_at' => $admin->created_at->format('d-m-Y H:i'),
                'actions' => "
                    <a href='" . route('admin.admins.edit', $admin->id) . "' class='btn btn-sm btn-primary'>
                        <i class='ti ti-pencil'></i> Edit
                    </a>
                    <button class='btn btn-sm btn-danger' onclick=\"if(confirm('Apakah Anda yakin?')) { document.getElementById('delete-form-{$admin->id}').submit(); }\">
                        <i class='ti ti-trash'></i> Hapus
                    </button>
                    <form id='delete-form-{$admin->id}' action='" . route('admin.admins.destroy', $admin->id) . "' method='POST' style='display:none;'>
                        " . csrf_field() . "
                        " . method_field('DELETE') . "
                    </form>
                "
            ];
        })->toArray();

        return response()->json([
            "draw" => $request->draw,
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            'data' => $data
        ], 200);
    }
}
