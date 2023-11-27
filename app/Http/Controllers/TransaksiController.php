<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Mobil;
use App\Models\User;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $Transaksi = Transaksi::all();
        $dataMobil = Mobil::all();
        $dataUser = User::all();
        $listTransaksi = array_merge($Transaksi,$dataMobil,$dataUser);
        return view('transaksi.index', compact('listTransaksi'));
    }

    public function viewPeminjaman()
    {
        $Transaksi = Transaksi::all();
        $dataMobil = Mobil::all();
        $dataUser = User::all();
        $listTransaksi = array_merge($Transaksi,$dataMobil,$dataUser);
        return view('transaksi.peminjaman.index', compact('listPeminjaman'));
    }

    public function viewPengembalian()
    {
        $Transaksi = Transaksi::all();
        $dataMobil = Mobil::all();
        $dataUser = User::all();
        $listTransaksi = array_merge($Transaksi,$dataMobil,$dataUser);
        return view('transaksi.pengembalian.index', compact('listPengembalian'));
    }

    public function addPeminjaman()
    {
        return view('transaksi.peminjaman.create');
    }

    public function addPengembalian()
    {
        return view('transaksi.pengembalian.create');
    }

    public function storePeminjaman(Request $request)
    {
        $this->validate($request, [
            'no_plat' => 'required|string',
            'tanggal_mulai' => 'required|string',
            'tanggal_selesai' => 'required|string',
            'tarif' => 'required|integer',
            'status' => 'required|string'
        ]);

        $peminjaman = Transaksi::create([
            'id_user' => $request->id_user,
            'id_mobil' => $request->id_mobil,
            'no_plat' => $request->no_plat,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'tarif' => $request->tarif,
            'status' => $request->status
        ]);

        if ($peminjaman) {
            return redirect()
                ->route('transaksi.peminjaman.index')
                ->with([
                    'success' => 'Data peminjaman baru telah berhasil dibuat'
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

    public function updatePeminjaman(Request $request)
    {
        $this->validate($request, [
            'no_plat' => 'required|string',
            'tanggal_mulai' => 'required|string',
            'tanggal_selesai' => 'required|string',
            'tarif' => 'required|integer',
            'status' => 'required|string'
        ]);

        $peminjaman = Transaksi::findOrFail($id_transaksi);
        $peminjaman->update([
            'id_user' => $request->id_user,
            'id_mobil' => $request->id_mobil,
            'no_plat' => $request->no_plat,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'tarif' => $request->tarif,
            'status' => $request->status
        ]);

        if ($peminjaman) {
            return redirect()
                ->route('transaksi.peminjaman.index')
                ->with([
                    'success' => 'Data peminjaman baru telah berhasil dibuat'
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
    
    public function pengembalianAction(Request $request)
    {
        $this->validate($request, [
            'no_plat' => 'required|string',
            'tanggal_mulai' => 'required|string',
            'tanggal_pengembalian' => 'required|string',
            'tarif' => 'required|integer',
            'status' => 'required|string'
        ]);

        $pengembalian = Transaksi::findOrFail($id_transaksi);
        $pengembalian->update([
            'id_user' => $request->id_user,
            'id_mobil' => $request->id_mobil,
            'no_plat' => $request->no_plat,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
            'tarif' => $request->tarif,
            'status' => $request->status
        ]);

        if ($pengembalian) {
            return redirect()
                ->route('transaksi.pengembalian.index')
                ->with([
                    'success' => 'Data pengembalian baru telah berhasil dibuat'
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

    public function destroy($id_transaksi)
    {
        $transaksi = Transaksi::findOrFail($id_transaksi);
        $transaksi->delete();

        if ($transaksi) {
            return redirect()
                ->route('transaksi.index')
                ->with([
                    'success' => 'Data transaksi telah berhasil dihapus'
                ]);
        } else {
            return redirect()
                ->route('transaksi.index')
                ->with([
                    'error' => 'Upss ada masalah saat hapus data, coba ulang lagi'
                ]);
        }
    }

}
