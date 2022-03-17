<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {   //Profit-focused foreground neural-net
        // Virtual foreground opensystem
        // Balanced stable attitude

        $test_data = ['Profit-focused foreground neural-net','Virtual foreground opensystem','Balanced stable attitude'];

        return [
            'name' => $this->faker->firstName(),
            'surname' => $this->faker->lastName(),
            'description' => $this->faker->paragraphs(3, true),
            'company_title' => $test_data[rand(0,2)]

        ];
    }
}
