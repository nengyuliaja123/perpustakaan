<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // satu data peminjaman memiliki satu data perpus
    public function perpus()
    {
        return $this->belongsTo(Perpus::class);
    }
    // satu data peminjaman memiliki satu data user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
