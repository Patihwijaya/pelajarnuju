<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    public function index()
    {
        Gate::authorize('viewAny', User::class);

        $query = User::with('profil');

        if (!Gate::allows('super_admin')) {
            $query->where('role', 'user');
        }

        $users = $query->orderBy('created_at', 'desc')->get();

        return view('user.user-management.index', compact('users'));
    }

    public function create()
    {
        Gate::authorize('create', User::class);

        return view('user.user-management.create');
    }

    public function store(Request $request)
    {
        Gate::authorize('create', User::class);

        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'nomor_ponsel' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $role = 'user';
        if (Gate::allows('super_admin') && in_array($request->role, ['admin', 'user'])) {
            $role = $request->role;
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nomor_ponsel' => $request->nomor_ponsel,
            'password' => Hash::make($request->password),
            'role' => $role,
        ]);

        return redirect()->route('user-management.index')->with('success', 'User berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        Gate::authorize('update', $user);

        return view('user.user-management.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        Gate::authorize('update', $user);

        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'nomor_ponsel' => 'required',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'nomor_ponsel' => $request->nomor_ponsel,
        ];

        if (Gate::allows('super_admin') && in_array($request->role, ['admin', 'user'])) {
            $data['role'] = $request->role;
        }

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('user-management.index')->with('success', 'User berhasil diperbarui!');
    }

    public function destroy(User $user)
    {
        Gate::authorize('delete', $user);

        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }

        $user->delete();

        return redirect()->route('user-management.index')->with('success', 'User berhasil dihapus!');
    }
}
