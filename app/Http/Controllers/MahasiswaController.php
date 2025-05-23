<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::with('user')->get();
        return view('mahasiswa.index', compact('mahasiswa'));
    }

    public function create()
    {
        return view('mahasiswa.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|integer|unique:mahasiswas,nim',
            'email' => 'required|email|unique:users,email',
            'prodi' => 'required|in:IFSI-S1,KA-D3,MI-D3,IF-D3',
            'isActive' => 'required|boolean',
        ]);

        $user = User::create([
            'name' => $validated['nama'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['nim']), 
        ]);

        $mahasiswa = Mahasiswa::create([
            'nama' => $validated['nama'],
            'nim' => $validated['nim'],
            'prodi' => $validated['prodi'],
            'isActive' => $validated['isActive'],
            'user_id' => $user->id,
        ]);

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa dan akun user berhasil ditambahkan. Password default: ' . $validated['nim']);
    }

    public function show(Mahasiswa $mahasiswa)
    {
        $mahasiswa->load('user');
        return view('books.index', compact('mahasiswa'));
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        $users = User::whereDoesntHave('mahasiswa')
            ->orWhere('id', $mahasiswa->user_id)
            ->get();
        
        return view('mahasiswa.edit', compact('mahasiswa', 'users'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        try {
            $validated = $request->validate([
                'nama' => 'required|string|max:255',
                'nim' => ['required', 'integer', Rule::unique('mahasiswas')->ignore($mahasiswa->id)],
                'prodi' => 'required|in:IFSI-S1,KA-D3,MI-D3,IF-D3',
                'isActive' => 'required|in:0,1',
                'user_id' => [
                    'nullable',
                    'exists:users,id',
                    Rule::unique('mahasiswas')->ignore($mahasiswa->id)
                ],
            ]);

            // Update mahasiswa
            $mahasiswa->update([
                'nama' => $validated['nama'],
                'nim' => $validated['nim'],
                'prodi' => $validated['prodi'],
                'isActive' => (bool)$validated['isActive'],
                'user_id' => $validated['user_id'],
            ]);

            // Update user terkait jika ada dan email diisi
            if ($mahasiswa->user && $request->filled('user_email')) {
                $request->validate([
                    'user_email' => 'email|unique:users,email,' . $mahasiswa->user->id,
                ]);
                
                $userUpdateData = ['email' => $request->user_email];
                
                // Update nama user jika checkbox dicentang
                if ($request->has('update_user_name')) {
                    $userUpdateData['name'] = $validated['nama'];
                }
                
                $mahasiswa->user->update($userUpdateData);
            }

            return redirect()->route('mahasiswa.index')
                ->with('success', 'Mahasiswa berhasil diperbarui.');
                
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])
                        ->withInput();
        }
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa berhasil dihapus.');
    }
}