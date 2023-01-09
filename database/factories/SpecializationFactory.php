<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use App\models\Specialization;

class SpecializationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
                'name' => $this->faker->name(),
                //
            ];
    }
}
