<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Prodi;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswa = mahasiswa::all(); //perintah sql select * from maha
        // dd($mahasiswa);//dump and die
        return view('mahasiswa.index')->with('mahasiwa', $mahasiswa);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $prodi = Prodi::all(); // ambil semua data prodi
        return view('mahasiswa.create', compact('prodi')); // mengirimkan data prodi ke view mahasiswa.create
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'npm' => 'required|unique:mahasiswa',
            'nama' => 'required',
            'jk' => 'required',
            'tanggal_lahir' => 'required',
            'tempat_lahir' => 'required',
            'asal_sma' => 'required',
            'prodi_id' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->file('foto')) {
            $file = $request->file('foto'); // ambil file foto
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename); // simpan file ke folder images
            $input['foto'] = $filename; // simpan nama file ke database
        }

        Mahasiswa::create($input);
        // redirect ke route mahasiswa.index
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        //
        //dd($mahasiswa);
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        $prodi = Prodi::all(); // ambil semua data prodi
        return view('mahasiswa.edit', compact('mahasiswa', 'prodi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($mahasiswa)
    {
        $mahasiswa = Mahasiswa::findOrFail($mahasiswa);

        if ($mahasiswa->foto) {
            $fotoPath = public_path('images/' . $mahasiswa->foto);
            if (file_exists($fotoPath)) {
                unlink($fotoPath);
            }
        }

        //hapus data mahasiswa
        $mahasiswa->delete();

        //redirect ke halaman mahasiswa.index
        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil dihapus!');
    }
}
