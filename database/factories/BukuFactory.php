<?php

namespace Database\Factories;

use App\Models\Buku;
use Illuminate\Database\Eloquent\Factories\Factory;

class BukuFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Buku::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_penerbit' => rand(1,6),
            'id_pengarang' => rand(1,4),
            'id_katalog' => rand(1,5),
            'isbn' => $this->faker->randomNumber(9,true),
            'judul' => $this->faker->sentence(rand(2,4)),
            'tahun' => $this->faker->year('+5 years'),
            'qty_stok' => $this->faker->randomNumber(3),
            'harga_pinjam' => rand(5000,50000)
        ];
    }
}
