<?php

namespace Database\Factories;

use App\Enums\Genre;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => rtrim(fake()->sentence(5), '.'),
            'publisher' => fake()->company(),
            'author' => fake()->name(),
            'genre' => fake()->randomElement(Genre::class),
            'publication_date' => fake()->dateTimeBetween('-20 years', '-2 days'),
            'words_number' => fake()->numberBetween(10000, 1000000),
            'price' => fake()->numberBetween(10, 100)
        ];
    }
}
