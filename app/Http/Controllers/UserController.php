<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Menampilkan form untuk menambah user
    public function create()
    {
        return view('users.create'); // Ganti dengan nama view yang sesuai
    }

    // Menyimpan user baru ke database
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'NIP' => 'required||string|max:255',
            'nama_user' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed', // Validasi password dan konfirmasi
            'role' => 'required|in:1,2', // Validasi role
        ]);

        // Menghash password sebelum menyimpannya
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Membuat user baru
        User::create($validatedData);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }



    public function index(Request $request)
    {
        $search = $request->input('search');
        $users = User::when($search, function ($query) use ($search) {
            return $query->where('nama_user', 'like', '%' . $search . '%');
        })->paginate(12)->appends(request()->query());
        
        return view('users.index', compact('search', 'users'));
    }
    

    // Menampilkan form edit untuk pengguna
    public function edit($id_user) // Ganti parameter ke id_user untuk konsistensi
    {
        $user = User::findOrFail($id_user); // Mencari user berdasarkan ID
        return view('users.edit', compact('user')); // Menampilkan form edit dengan data user
    }

    // Memperbarui data pengguna
    public function update(Request $request, $id_user)
    {
        // Validasi input
        $validatedData = $request->validate([
            'NIP' => 'required||string|max:255',
            'nama_user' => 'required|string|max:255',
            'role' => 'required|in:1,2', // Validasi role
            'password' => 'nullable|string|min:8|confirmed' // Validasi password dan konfirmasi, nullable
        ]);

        $user = User::findOrFail($id_user); // Mencari user berdasarkan ID

        // Memperbarui data user
        if ($request->filled('password')) { // Cek jika password diberikan
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']); // Hapus password dari data yang akan diupdate
        }

        $user->update($validatedData); // Memperbarui data user

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
    }

    // Menghapus pengguna
    public function destroy($NIP) // Ganti parameter ke id_user untuk konsistensi
    {
        $user = User::findOrFail($NIP); // Mencari user berdasarkan ID
        $user->delete(); // Menghapus user

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}