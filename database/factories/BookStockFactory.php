<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\BookStock;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<BookStock>
 */
class BookStockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'book_id' => function () {
                return $this->faker->randomElement(Book::all())->id;
            },
        ];
    }
}
