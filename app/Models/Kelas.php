<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// tugas 1 = lanjutkan tambahkan select id_kelas di create dan update mahasiswa
// tambahkan nama_kelas di index mahasiswa lewat Mahasiswa::with('kelas');
class Kelas extends Model
{
    protected $table = 'kelas';

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class);
    }
}
