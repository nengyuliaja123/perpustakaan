<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // satu data detail peminjaman memiliki satu data buku
    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
}
