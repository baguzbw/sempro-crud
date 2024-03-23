<?php

namespace App\Http\Controllers;
use App\Models\Mahasiswa;

use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        //get mahasiswa
        $mahasiswas = Mahasiswa::orderBy('nim', 'desc')->paginate(5);
        
        // Ngitung jumlah pria dan wanita
        $jumlahPria = Mahasiswa::where('gender', 'pria')->count();
        $jumlahWanita = Mahasiswa::where('gender', 'wanita')->count();
        $jumlahSiswa = Mahasiswa::count();
    

        //render view with mahasiswa
        return view('mahasiswas.index', compact('mahasiswas', 'jumlahPria', 'jumlahWanita','jumlahSiswa'));
        return view('mahasiswas.dashboard', compact('mahasiswas'));
    }
    public function create()
    {
        return view('mahasiswas.create');
    }

    /**
     * store
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nim'       => 'required|string|min:4',
            'nama'      => 'required|string|min:4',
            'alamat'    => 'required|string|min:4',
            'tgl_lahir' => 'required|date',
            'gender'    => 'required|in:pria,wanita',
            'usia'      => 'required|integer|min:1',          
        ]);


        Mahasiswa::create([
            'nim'     => $request->nim,
            'nama'     => $request->nama,
            'alamat'     => $request->alamat,
            'tgl_lahir'     => $request->tgl_lahir,
            'gender'     => $request->gender,
            'usia'     => $request->usia
        ]);

        return redirect()->route('mahasiswas.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        return view('mahasiswas.edit', compact('mahasiswa'));
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $mahasiswa
     * @return void
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
{
    // Validate form
    $this->validate($request, [
        'nim'       => 'required|string|min:4',
        'nama'      => 'required|string|min:4',
        'alamat'    => 'required|string|min:4',
        'tgl_lahir' => 'required|date',
        'gender'    => 'required|in:pria,wanita',
        'usia'      => 'required|integer|min:1'
    ]);
   
    // Update mahasiswa
    $mahasiswa->update([
        'nim'       => $request->nim,
        'nama'      => $request->nama,
        'alamat'    => $request->alamat,
        'tgl_lahir' => $request->tgl_lahir,
        'gender'    => $request->gender,
        'usia'      => $request->usia
    ]);

    // Redirect to index
    return redirect()->route('mahasiswas.index')->with(['success' => 'Data Berhasil Diubah!']);
}
public function destroy(Mahasiswa $mahasiswa)
{

    //delete mahasiswa
    $mahasiswa->delete();

    //redirect to index
    return redirect()->route('mahasiswas.index')->with(['success' => 'Data Berhasil Dihapus!']);
}

}

