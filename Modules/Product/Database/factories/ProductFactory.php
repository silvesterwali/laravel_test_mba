<?php

namespace Modules\Product\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Product\Entities\Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama' => 'PD ' . $this->faker->word() . '-' . $this->faker->numberBetween(100, 1000),
            'harga' => $this->faker->randomFloat(2, 10000, 100000),
            'keterangan' => $this->faker->text(30),
            'persediaan' => $this->faker->randomFloat(2, 10000, 100000),
        ];
    }
}
