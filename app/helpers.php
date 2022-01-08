<?php

use App\Models\Peminjaman;
use Illuminate\Support\Facades\DB;

function countPassDay()
{
    return Peminjaman::where('tgl_kembali', '<', date('Y-m-d'))->where('status', 'belum')->count();
}

function dataPassDay()
{
    $dateNow = date('Y-m-d');
    $data = Peminjaman::select('*', DB::raw('DATEDIFF("' . $dateNow . '",tgl_kembali) as lama_lewat'))
        ->where('tgl_kembali', '<', date('Y-m-d'))
        ->where('status', 'belum')
        ->get();

    return $data;
}
