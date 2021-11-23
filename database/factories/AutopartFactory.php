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
        for ($i = 0; $i < 10; $i++) {
            $attribute_id = random_int(3, 34);
            $autopart_id = random_int(85, 487);
            \DB::table('attribute_autopart')->insert([
                'attribute_id' => $attribute_id,
                'autopart_id' => $autopart_id
            ]);
        }
        return [
            'name' => $this->faker->company(),
            'price' => $this->faker->numberBetween(100, 30000),
            'article' => $this->faker->asciify('***************'),
            'category_id' => $this->faker->numberBetween(1, 10)
        ];
    }
}
