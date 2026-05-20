<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

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
            'password' => 'required|min:8|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'min:8',
        ]);

        $user = User::findOrFail($id);

        if ($request->password) {
            $user->password = Hash::make($request->password);
            $user->update();
        }

        return redirect()->route('admin.users.index')->with('success', 'Password has been changed successfully');

    }

    public function updateLockStatus(Request $request, string $id)
    {
        try {
            $request->validate([
                'locked' => 'required|boolean',
            ]);

            $user = User::findOrFail($id);
            $user->manual_unlock = !$request->locked;
            $user->update();

            $isLocked = $request->locked;
            $message = $isLocked ? 'User has been locked' : 'User has been unlocked';

            Log::info($message, [
                'user_name' => $user->name,
                'user_email' => $user->email,
                'club' => $user->club,
                'updated_by_name' => auth()->user()->name,
                'ip' => $request->ip(),
                'at' => now()->toDateTimeString(),
            ]);

            return response()->json([
                'success' => true,
                'message' => $message . ' successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update user lock status: '.$e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        try {
            $user = User::findOrFail($id);
            $user_name = $user->name;
            $user_email = $user->email;
            $club = $user->club;
            $user->delete(); // Soft delete via SoftDeletes trait

            Log::info('User has been archived', [
                'user_name' => $user_name,
                'user_email' => $user_email,
                'club' => $club,
                'updated_by_name' => auth()->user()->name,
                'ip' => $request->ip(),
                'at' => now()->toDateTimeString(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'User has been archived successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to archive user: '.$e->getMessage(),
            ], 500);
        }
    }

    public function deleted()
    {
        return User::onlyTrashed()->get(); // only deleted users
    }

    public function restore($id)
    {
        User::withTrashed()->findOrFail($id)->restore();

        return redirect()->back()->with('success', 'User restored.');
    }

    public function forceDelete($id)
    {
        User::withTrashed()->findOrFail($id)->forceDelete();

        return redirect()->back()->with('success', 'User permanently deleted.');
    }

    public function getDataUsers(Request $request)
    {
        // Page Length
        $pageNumber = ($request->start / $request->length) + 1;
        $pageLength = $request->length;
        $skip = ($pageNumber - 1) * $pageLength;

        // Page Order
        $orderColumnIndex = $request->order[0]['column'] ?? '0';
        $orderBy = $request->order[0]['dir'] ?? 'desc';

        $query = DB::table('users')
            ->select('id', 'name', 'email', 'no_hp', 'club', 'manual_unlock', 'created_at')
            ->whereNull('deleted_at'); // excludes soft-deleted users;

        // Search
        $search = $request->search;
        $query = $query->where(function ($query) use ($search) {
            $query->orWhere('email', 'like', '%'.$search.'%');
            $query->orWhere('name', 'like', '%'.$search.'%');
            $query->orWhere('club', 'like', '%'.$search.'%');
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
        $recordsFiltered = $recordsTotal = $query->count();
        $users = $query->skip($skip)->take($pageLength)->get();

        return response()->json(['draw' => $request->draw, 'recordsTotal' => $recordsTotal, 'recordsFiltered' => $recordsFiltered, 'data' => $users], 200);
    }

    public function getDataDeletedUsers(Request $request)
    {
        // Page Length
        $pageNumber = ($request->start / $request->length) + 1;
        $pageLength = $request->length;
        $skip = ($pageNumber - 1) * $pageLength;

        // Page Order
        $orderColumnIndex = $request->order[0]['column'] ?? '0';
        $orderBy = $request->order[0]['dir'] ?? 'desc';

        $query = DB::table('users')
            ->select('id', 'name', 'email', 'no_hp', 'club', 'created_at')
            ->whereNotNull('deleted_at'); // only soft-deleted users

        // Search
        $search = $request->search;
        $query = $query->where(function ($query) use ($search) {
            $query->orWhere('email', 'like', '%'.$search.'%');
            $query->orWhere('name', 'like', '%'.$search.'%');
            $query->orWhere('club', 'like', '%'.$search.'%');
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
        $recordsFiltered = $recordsTotal = $query->count();
        $users = $query->skip($skip)->take($pageLength)->get();

        return response()->json(['draw' => $request->draw, 'recordsTotal' => $recordsTotal, 'recordsFiltered' => $recordsFiltered, 'data' => $users], 200);
    }

    public function restoreUser(string $id)
    {
        try {
            $user = User::withTrashed()->findOrFail($id);
            $user->restore();

            return response()->json([
                'success' => true,
                'message' => 'User has been restored successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to restore user: '.$e->getMessage(),
            ], 500);
        }
    }

    public function forceDeleteUser(string $id)
    {
        try {
            $user = User::withTrashed()->findOrFail($id);
            $user->forceDelete();

            return response()->json([
                'success' => true,
                'message' => 'User has been permanently deleted',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to permanently delete user: '.$e->getMessage(),
            ], 500);
        }
    }
}
