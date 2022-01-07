<?php

namespace Database\Factories;

use App\Models\Autopart;
use Illuminate\Database\Eloquent\Factories\Factory;

class AutopartFactory extends Factory
{
    protected $model = Autopart::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'price' => $this->faker->numberBetween(100, 30000),
            'article' => $this->faker->asciify('***************'),
            'category_id' => $this->faker->numberBetween(1, 10)
        ];
    }
}
