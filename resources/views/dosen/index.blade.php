@extends('layout.template')
@section('title', 'Daftar Dosen')
@section("content")
<br> <center><h2><b>Daftar Dosen</b></h2></center>

     <a href="{{ route('dosen.create') }}" class="btn btn-primary mb-3"> + Tambah Data</a>
     <form action="{{ route ('logout')}}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Logout</button>
     </form>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Alamat</th>
                <th>Gambar</th>
                <th>Aksi</th>
    
            </tr>
        </thead>
        <tbody>
            @forelse($dosen as $index => $mhs)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $mhs->nama }}</td>
                    <td>{{ $mhs->jabatan }}</td>
                    <td>{{ $mhs->alamat }}</td>
                    <td><img src="{{Storage::url ($mhs->gambar)}}" alt="" width="100px"></td>
                    <td>
                        <a href="{{ route('dosen.edit', $mhs->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('dosen.destroy', $mhs->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Del</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data dosen.</td>
                </tr>
            @endforelse
        </tbody>