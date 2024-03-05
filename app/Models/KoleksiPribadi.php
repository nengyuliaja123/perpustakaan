<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KoleksiPribadi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // satu data koleksi pribadi memiliki satu data buku
    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
}
