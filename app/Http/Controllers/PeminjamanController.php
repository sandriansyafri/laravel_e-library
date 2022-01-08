<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\DetailPeminjaman;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $datas = Peminjaman::select('*', DB::raw('DATEDIFF(tgl_kembali,tgl_pinjam) as lama_pinjam'))->get();

        if ($request->status) {
            $datas = $datas->where('status', $request->status);
        }

        if ($request->tgl_pinjam) {
            $datas = $datas->where('tgl_pinjam', $request->tgl_pinjam);
        }


        foreach ($datas as $data) {
            $total_bayar = 0;

            foreach ($data->buku as $buku) {
                $total_bayar += $buku->harga_pinjam;
            }
            $data->total_bayar = 'Rp. ' . number_format($total_bayar * $data->lama_pinjam);

            $data->lists_buku = Buku::all();
            $data->buku_dipinjam = DetailPeminjaman::where('id_peminjaman', $data->id)->pluck('id_buku');

            foreach ($data->lists_buku as $list_buku) {
                $list_buku->dipinjam = in_array($list_buku->id, $data->buku_dipinjam->toArray());
            }
        }


        return datatables()->of($datas)
            ->addIndexColumn()
            ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_anggota' => 'required',
            'tgl_pinjam' => 'required',
            'tgl_kembali' => 'required'
        ]);

        $peminjaman = new Peminjaman();
        $peminjaman->id_anggota = $request->id_anggota;
        $peminjaman->tgl_pinjam = $request->tgl_pinjam;
        $peminjaman->tgl_kembali = $request->tgl_kembali;

        $peminjaman->status = 'belum';
        $peminjaman->save();

        $id_bukus = $request->id_buku;
        foreach ($id_bukus as $id_buku) {
            $detail_peminjaman = new DetailPeminjaman();
            $detail_peminjaman->id_peminjaman = $peminjaman->id;
            $detail_peminjaman->id_buku = $id_buku;
            $detail_peminjaman->qty = 1;
            $detail_peminjaman->save();

            $buku = Buku::firstWhere('id', $id_buku);
            $siswa_buku = $buku->qty_stok - 1;
            $buku->update([
                'qty_stok' => $siswa_buku
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Peminjaman $peminjaman)
    {
        $request->validate([
            'status' => 'required'
        ]);

        $peminjaman->update([
            'tgl_kembali' => $request->tgl_kembali,
            'status' => $request->status
        ]);

        DetailPeminjaman::where('id_peminjaman', $peminjaman->id)->delete();

        foreach ($request->id_buku as $id_buku) {
            $detail_peminjaman = new DetailPeminjaman();
            $detail_peminjaman->id_buku = $id_buku;
            $detail_peminjaman->id_peminjaman = $peminjaman->id;
            $detail_peminjaman->qty  = 1;
            $detail_peminjaman->save();

            if ($request->status === 'sudah') {
                $buku = Buku::firstWhere('id', $id_buku);
                $sisa_stok = $buku->qty_stok + 1;
                $buku->update([
                    'qty_stok' => $sisa_stok
                ]);
            }

            $current_status = Peminjaman::firstWhere('id', $peminjaman->id);

            dd($current_status->status);


            if ($request->status === 'belum ' && $current_status->status === 'sudah') {
                $buku = Buku::firstWhere('id', $id_buku);
                $sisa_stok = $buku->qty_stok - 1;
                $buku->update([
                    'qty_stok' => $sisa_stok
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Peminjaman $peminjaman)
    {
    }
}
