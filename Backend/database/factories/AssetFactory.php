<?php

namespace Database\Factories;

use App\Models\Asset;
use App\Models\Kategori;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Asset>
 */
class AssetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Asset::class;

    public function definition()
    {
        return [
            'kode' => 'AST-' . $this->faker->unique()->randomNumber(5),
            'uuid' => $this->faker->uuid(),
            'name' => $this->faker->word,
            'image' => 'public/images/News/example.png',
            'description' => $this->faker->paragraph,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Asset $asset) {
            $kategori = Kategori::inRandomOrder()->first();
            $asset->kategori()->attach($kategori, ['created_at' => now(), 'updated_at' => now()]);
            $status = Status::inRandomOrder()->first();
            $asset->statusAset()->attach($status, ['created_at' => now(), 'updated_at' => now()]);
        });
    }
}
