<?php

namespace Database\Factories {

    use Illuminate\Database;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Str;

    class UserFactory extends Database\Eloquent\Factories\Factory
    {
        /**
         * The current password being used by the factory.
         */
        protected static ?string $password;

        /** @inheritdoc */
        public function definition(): array
        {
            return [
                'name'              => fake()->name(),
                'username'          => fake()->username(),
                'email'             => fake()->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password'          => static::$password ??= Hash::make('password'),
                'remember_token'    => Str::random(10),
                'website'           => fake()->url(),
            ];
        }

        /**
         * Indicate that the model's email address should be unverified.
         */
        public function unverified(): static
        {
            return $this->state(fn(array $attributes) => [
                'email_verified_at' => null,
            ]);
        }
    }
}
