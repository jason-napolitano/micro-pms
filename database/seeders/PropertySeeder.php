<?php

namespace Database\Seeders {

    use App\Models\User;
    use Illuminate\Database\Seeder;
    use App\Models\Property;

    class PropertySeeder extends Seeder
    {
        /**
         * Run the database seeds.
         */
        public function run(): void
        {
            $property = Property::create([
                'address' => fake()->address(),
                'phone'   => fake()->phoneNumber(),
                'name'    => fake()->company(),
                'code'    => 'CODE',
            ]);

            $property->users()->attach(User::role('admin')->first());
        }
    }
}
