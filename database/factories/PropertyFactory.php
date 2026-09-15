<?php

namespace Database\Factories {

    use Illuminate\Database;

    class PropertyFactory extends Database\Eloquent\Factories\Factory
    {
        /** @inheritdoc */
        public function definition(): array
        {
            return [
                'address' => fake()->address(),
                'phone'   => fake()->phoneNumber(),
                'name'    => fake()->company(),
                'code'    => strtoupper(fake()->word()),
            ];
        }
    }
}
