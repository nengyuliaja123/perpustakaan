<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuUlasan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // satu data ulasan memiliki satu data buku
    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
    // satu data ulasan memiliki satu data user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
