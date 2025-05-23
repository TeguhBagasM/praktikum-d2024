<?php

namespace Database\Seeders;

use App\Models\Note;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Note::factory(10)->create();
        Note::create([ 
            'judul' => 'catatan harian',
            'konten' => 'hari ini blablablaba.',
            'tanggal_dibuat' => Carbon::now()->format('Y-m-d H:i:s'),
        ]); 
    }
}
