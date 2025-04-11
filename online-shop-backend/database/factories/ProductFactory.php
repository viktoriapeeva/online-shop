<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // hardcoded product names
            'name' => $this->faker->randomElement([
                'Laptop',
                'Smartphone',
                'Headphones',
                'Smartwatch',
                'Camera',
                'Tablet',
                'Monitor',
                'Keyboard',
                'Mouse',
                'Printer'
            ]),
            'description' => $this->faker->sentence(10),
            'price' => $this->faker->randomFloat(2, 10, 1000), // price between 10 and 1000
            'category_id' => Category::inRandomOrder()->first()->id, // random category id
            'stock' => $this->faker->numberBetween(1, 100), // stock between 1 and 100

            
        ];
    }
}
