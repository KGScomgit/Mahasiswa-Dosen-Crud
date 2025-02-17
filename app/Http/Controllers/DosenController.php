<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dosen;
use Illuminate\Support\Facades\Storage;

class DosenController extends Controller
{
    public function index()
    {
        $dosen = Dosen::all();
        return view('dosen.index', compact('dosen'));
    }

    public function create()
    {
        return view('dosen.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'alamat' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg|max:2048' 
        ]);

        $validated['gambar'] = $request->file('gambar')->store('img_dosen', 'public');
        
        Dosen::create($validated);
    
        return redirect()->route('dosen.index')->with('success', 'Data berhasil ditambahkan!');
    }
        public function edit($id)
    
        {
            $dosen = Dosen::findOrFail($id);
            return view('dosen.edit', compact('dosen'));
        }

        public function update(Request $request, $id)
        {
            $dosen = Dosen::findOrFail($id);
            $validated = $request->validate([
                'nama' => 'required',
                'jabatan' => 'required',
                'alamat' => 'required',
                'gambar' => 'image|mimes:jpeg,png,jpg|max:2048' 
            ]);

            if ($request->hasFile('gambar')){
                if ($dosen->gambar){
                    Storage::delete('public/'. $dosen->gambar);
                }

                $validated['gambar'] = $request->file('gambar')->store('img_dosen', 'public');
            }

            $dosen->update($validated);
            return redirect()->route('dosen.index')->with('success', 'Data berhasil diperbarui!');
        }
        public function destroy($id)
        {
            Dosen::destroy($id);
            return redirect()->route('dosen.index')->with('success', 'Data berhasil dihapus!');
        }
    
}