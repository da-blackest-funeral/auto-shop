<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    protected $model = Car::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'model' => $this->faker->company(),
            'registration_number' => $this->faker->randomLetter .
                $this->faker->numerify() . $this->faker->randomLetter . $this->faker->randomLetter,
            'brand' => $this->faker->word,
            'year' => $this->faker->year,
        ];
    }
}
