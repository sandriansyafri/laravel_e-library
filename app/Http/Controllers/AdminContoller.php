<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Katalog;
use App\Models\Peminjaman;
use App\Models\Penerbit;
use App\Models\Pengarang;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminContoller extends Controller
{
    public function test_spatie()
    {
        $role = Role::create(['name' => 'admin']);
        $permission = Permission::create(['name' => 'page_peminjaman']);

        $role->givePermissionTo($permission);
        $permission->assignRole($role);
        $user = User::firstWhere('email', 'sandrian@gmail.com');
        $user->assignRole('admin');

        $user = User::with('roles')->get();
        $user = User::with(['roles'])->get();
        return $user;
    }

    public function index()
    {
        $total_anggota = Anggota::count();
        $total_buku = Buku::count();
        $total_penerbit = Penerbit::count();
        $total_peminjaman = Peminjaman::count();

        // $label_penerbits = Penerbit::join('bukus', 'penerbits.id', '=', 'bukus.id_penerbit')
        //     ->orderBy('bukus.id_penerbit', 'ASC')
        //     ->groupBy('penerbits.id')
        //     ->pluck('penerbits.nama_penerbit');
        $label_penerbits = Penerbit::with(['buku' => function ($query) {
            $query->orderBy('id_penerbit');
        }])
            ->groupBy('id')
            ->pluck('nama_penerbit');


        $data_penerbits = Buku::select(DB::raw('COUNT(id_penerbit) as total'))
            ->groupBy('id_penerbit')
            ->orderBy('id_penerbit', 'ASC')
            ->pluck('total');


        $label_pengarangs = DB::table('pengarangs')
            ->join('bukus', 'bukus.id_penerbit', '=', 'pengarangs.id')
            ->select('pengarangs.nama_pengarang')
            ->orderBy('pengarangs.id', 'ASC')
            ->groupBy('pengarangs.id')
            ->pluck('nama_pengarang');

        $data_pengarangs = DB::table('bukus')
            ->select(DB::raw("COUNT(id_pengarang) as total"))
            ->groupBy('id_pengarang')
            ->orderBy('id_pengarang', 'ASC')
            ->pluck('total');

        $labels_bar = ['Peminjaman', 'Pengembalian'];
        $data_bar = [];

        foreach ($labels_bar as $index => $label_bar) {
            $data_bar[$index]['label'] = $labels_bar[$index];
            $data_bar[$index]['backgroundColor'] = $index === 0 ? 'rgba(60,141,188,0.9)' : 'red';
            $data_month = [];

            foreach (range(1, 12) as $month) {
                if ($index === 0) {
                    $data_month[] =  Peminjaman::select(DB::raw('COUNT(*) as total'))->whereMonth('tgl_pinjam', $month)->first()->total;
                } else {
                    $data_month[] =  Peminjaman::select(DB::raw('COUNT(*) as total'))->whereMonth('tgl_kembali', $month)
                        ->where('status', 'sudah')
                        ->first()->total;
                }
            }

            $data_bar[$index]['data'] = $data_month;
        }



        return view(
            'admin.dashboard.index',
            compact([
                'total_anggota', 'total_buku', 'total_penerbit', 'total_peminjaman',
                'label_penerbits', 'data_penerbits',
                'label_pengarangs', 'data_pengarangs',
                'data_bar'
            ])
        );
    }

    public function anggota()
    {
        return view('admin.anggota.index');
    }

    public function katalog()
    {
        $katalogs = Katalog::all();
        return view('admin.katalog.index', compact('katalogs'));
    }

    public function penerbit()
    {
        $penerbits = Penerbit::all();
        return view('admin.penerbit.index', compact('penerbits'));
    }

    public function pengarang()
    {
        $pengarangs = Pengarang::all();
        return view('admin.pengarang.index', compact('pengarangs'));
    }

    public function buku()
    {
        $katalogs = Katalog::all();
        $penerbits = Penerbit::all();
        $pengarangs = Pengarang::all();
        return view('admin.buku.index', compact([
            'katalogs', 'penerbits', 'pengarangs'
        ]));
    }

    public function peminjaman()
    {
        $anggotas = Anggota::all();
        $bukus = Buku::all();
        return view('admin.peminjaman.index', compact(['anggotas', 'bukus']));
    }
}
