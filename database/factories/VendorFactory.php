<?php

namespace Database\Factories {

    use Illuminate\Database;

    class VendorFactory extends Database\Eloquent\Factories\Factory
    {
        /** @inheritdoc */
        public function definition(): array
        {
            return [
                'contact_phone' => fake()->phoneNumber(),
                'contact_email' => fake()->email(),
                'contact_name'  => fake()->name(),
                'phone'         => fake()->phoneNumber(),
                'email'         => fake()->email(),
                'name'          => fake()->company(),
            ];
        }
    }
}
