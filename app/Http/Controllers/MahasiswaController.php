<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
    // Menampilkan daftar mahasiswa
    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        return view('mahasiswa.index', compact('mahasiswa'));
    }

    // Menampilkan form tambah data
    public function create()
    {
        return view('mahasiswa.create');
    }

    // Menyimpan data mahasiswa
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'nim' => 'required|unique:mahasiswa,nim',
            'jurusan' => 'required',
            'email' => 'required|email|unique:mahasiswa,email',
            'gambar' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $validated['gambar'] = $request->file('gambar')->store('img_mahasiswa', 'public');
    
        Mahasiswa::create($validated); // Menyimpan data mahasiswa
    
        return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil ditambahkan!');
    }
    // Menampilkan form edit
    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    // Memperbarui data mahasiswa
    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $validated = $request->validate([
          'name' => 'required',
           'nim' => 'required|unique:mahasiswa,nim',
            'jurusan' => 'required',
            'email' => 'required|email|unique:mahasiswa,email',
            'gambar' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);


        if ($request->hasFile('gambar')){
            if ($mahasiswa->gambar){
                Storage::delete('public/'. $mahasiswa->gambar);
            }

            $validated['gambar'] = $request->file('gambar')->store('img_mahasiswa', 'public');
        }

        $mahasiswa->update($validated);
        return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil diperbarui!');
    }
    public function destroy($id)
    {
        Mahasiswa::destroy($id);
        return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil dihapus!');
    }

}