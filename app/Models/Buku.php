<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['penerbit','katalog','pengarang'];

    public function peminjaman()
    {
        return $this->belongsToMany(Peminjaman::class, 'detail_peminjaman', 'id_buku', 'id_peminjaman');
    }

    public function katalog()
    {
        return $this->belongsTo(Katalog::class, 'id_katalog', 'id');
    }
    public function penerbit()
    {
        return $this->belongsTo(Penerbit::class, 'id_penerbit', 'id');
    }
    public function pengarang()
    {
        return $this->belongsTo(Pengarang::class, 'id_pengarang', 'id');
    }
}
