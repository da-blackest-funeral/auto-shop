<?php

namespace Database\Factories;

use App\Models\Attribute;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttributeFactory extends Factory
{
    protected $model = Attribute::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array {
        return [
            'title' => $this->faker->word(),
            'value' => $this->faker->word(),
            'description' => $this->faker->text(),
            'autopart_id' => $this->faker->numberBetween(100, 200)
        ];
    }
}
