<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.index');
    }


    public function list(Request $request)
    {
        if ($request->ajax()) {
            $dataPromosi = User::select("uuid", "name", "email", "role")->get();
            // dd($dataPromosi);
            return DataTables::of($dataPromosi)
                ->addIndexColumn()
                ->make(true);
        }
        return response()->json(['message' => 'Method not allowed'], 405);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest  $request)
    {
        $validated = $request->validated();

        $validated['password'] = Hash::make($validated['password']); // Use Hash facade

        User::create($validated);

        return redirect()->route('user.index')->with('success', 'User Berhasil Ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $uuid)
    {
        $user = User::where('uuid', $uuid)->firstOrFail();
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest  $request, string $uuid)
    {
        $user = User::where('uuid', $uuid)->firstOrFail();

        // Validate and update the user
        $validated = $request->validated();

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']); // Use Hash facade
        } else {
            unset($validated['password']); // Don't update password if not provided
        }

        $user->update($validated);

        return redirect()->route('user.index')->with('success', 'User Berhasil di updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        if (!auth()->check()) {
            return response()->json(['success' => false, 'message' => 'You must be logged in to perform this action.'], 403);
        }

        DB::beginTransaction();

        try {
            $user = User::where('uuid', $uuid)->firstOrFail();
            $user->delete();

            DB::commit();

            return response()->json(['success' => true, 'message' => 'User deleted successfully.'], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'User not found.'], 404);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'An error occurred while deleting the user.'], 500);
        }
    }
}
