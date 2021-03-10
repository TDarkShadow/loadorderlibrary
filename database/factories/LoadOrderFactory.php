<?php

namespace Database\Factories;

use App\LoadOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

class LoadOrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LoadOrder::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
		return [
			'name' => $this->faker->name,
			'description' => $this->faker->sentence,
			'slug' => $this->faker->slug(),
			'files' => $this->faker->file(base_path('/test-files/gatolist'), base_path('/storage/testing')),
			'game_id' => $this->faker->randomNumber(1),
			'is_private' => $this->faker->boolean()
		];
    }
}
