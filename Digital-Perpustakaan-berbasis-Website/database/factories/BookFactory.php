<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    protected $model = Book::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $coverPath = 'covers/' . $this->faker->image('public/covers', 640, 480, null, false);
        $filePath = 'files/' . $this->faker->file('public/files', null, false);

        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'amount' => $this->faker->numberBetween(1, 10),
            'cover' => $coverPath,
            'file_path' => $filePath,
            'category_id' => $this->faker->numberBetween(1, 10),
            'user_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
