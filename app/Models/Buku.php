<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // satu data buku memiliki satu data perpus
    public function perpus()
    {
        return $this->belongsTo(Perpus::class);
    }
    // satu data buku memiliki satu data kategori
    public function bukuKategori()
    {
        return $this->belongsTo('App\Models\BukuKategori', 'kategori_id', 'id');
    }
    // satu data buku memiliki banyak data koleksi pribadi
    public function koleksiPribadi()
    {
        return $this->hasMany(KoleksiPribadi::class);
    }
    // jika user yang ter autentikasi telah menambahkan buku ke koleksi pribadi
    public function isAuthUserKoleksiPribadi()
    {
        return $this->koleksiPribadi()->where('user_id',  auth()->id())->exists();
    }
}
