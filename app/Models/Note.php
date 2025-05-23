<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    // mass assigment
    // ini untuk kalo nam table di db engga jamak
    // protected $table = "catatan";

    // yang bisa diisi
    protected $fillable = ["judul", "konten", "tanggal_dibuat"];

    // ini yang gabisa diisi
    // protected $guarded = ["id"];
}
