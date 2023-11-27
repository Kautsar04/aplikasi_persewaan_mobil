<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use Illuminate\Http\Request;

class MobilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listMobil = Mobil::all();
        return view('mobil.index', compact('listMobil'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mobil.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'merek' => 'required|string',
            'model' => 'required|string',
            'no_plat' => 'required|string',
            'tarif' => 'required|integer'
        ]);

        $mobil = Mobil::create([
            'merek' => $request->merek,
            'model' => $request->model,
            'no_plat' => $request->no_plat,
            'tarif' => $request->tarif
        ]);

        if ($mobil) {
            return redirect()
                ->route('mobil.index')
                ->with([
                    'success' => 'Data mobil baru telah berhasil dibuat'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Upss ada masalah saat tambah data, coba ulang lagi'
                ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_mobil)
    {
        $mobil = Mobil::findOrFail($id_mobil);
        return view('mobil.edit', compact('mobil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_mobil)
    {
        $this->validate($request, [
            'merek' => 'required|string',
            'model' => 'required|string',
            'no_plat' => 'required|string',
            'tarif' => 'required|integer'
        ]);

        $mobil = Mobil::findOrFail($id_mobil);
        $mobil->update([
            'merek' => $request->merek,
            'model' => $request->model,
            'no_plat' => $request->no_plat,
            'tarif' => $request->tarif
        ]);

        if ($mobil) {
            return redirect()
                ->route('mobil.index')
                ->with([
                    'success' => 'Data mobil telah berhasil diubah'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Upss ada masalah saat ubah data, coba ulang lagi'
                ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_mobil)
    {
        $mobil = Mobil::findOrFail($id_mobil);
        $mobil->delete();

        if ($mobil) {
            return redirect()
                ->route('mobil.index')
                ->with([
                    'success' => 'Data mobil telah berhasil dihapus'
                ]);
        } else {
            return redirect()
                ->route('mobil.index')
                ->with([
                    'error' => 'Upss ada masalah saat hapus data, coba ulang lagi'
                ]);
        }
    }
}
