<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'judul' => $this->faker->sentence(), // judul random
            'konten' => $this->faker->paragraph(), // isi konten random
            'tanggal_dibuat' => $this->faker->dateTimeThisYear(), // tanggal random tahun ini
        ];
    }
}
