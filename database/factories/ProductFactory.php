<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
//        $imagePath = $this->faker->image(storage_path('app/public/images'), 400,300,null,false);
//        $imagePath = $this->faker->imageUrl(400, 300);
//        $imagePath = 'images/' . $this->faker->image(storage_path('app/public/images'), 400, 300, null, false);

        return [
            //
            'name' => $this->faker->text(20),
            'price' => $this->faker->numberBetween(100,10000),
//            'image' => fake()->image('public/storage/images', 400, 300, null, false),
//            'image' => 'images/' . basename($imagePath),
//            'image' => 'images/' . $this->faker->image('public/storage/images', 400, 300, null, false),
            'image' =>  $this->faker->image('public/storage/images', 400, 300, null, false),
//            'image' => $imagePath,
            'description' => $this->faker->text(100),
//            'user_id' => \App\Models\User::factory(),
            'user_id' => $this->faker->randomElement([1,2,13]),
//            'user_id' => User::factory()->create()->id,
        ];
    }
}
