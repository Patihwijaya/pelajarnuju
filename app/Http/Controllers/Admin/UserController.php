<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        // $users = User::with('profil')->orderBy('created_at', 'desc')->get();
        $users = User::with('profil')->get();
        return view('admin.users.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::with('profil')->findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus!');
    }
}
