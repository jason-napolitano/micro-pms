<?php

namespace Database\Seeders {

    use Illuminate\Database\Seeder;
    use App\Models\FloorPlan;
    use App\Models\Property;

    class FloorPlanSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         */
        public function run(): void
        {
            FloorPlan::create([
                'label'       => 'Studio',
                'bathrooms'   => 1,
                'bedrooms'    => 0,
                'square_feet' => 650,
                'property_id' => Property::inRandomOrder()->first()->id,
            ]);

            FloorPlan::create([
                'label'       => '1x1',
                'bathrooms'   => 1,
                'bedrooms'    => 1,
                'square_feet' => 749,
                'property_id' => Property::inRandomOrder()->first()->id,
            ]);

            FloorPlan::create([
                'label'       => '2x1',
                'bathrooms'   => 1,
                'bedrooms'    => 2,
                'square_feet' => 802,
                'property_id' => Property::inRandomOrder()->first()->id,
            ]);

            FloorPlan::create([
                'label'       => '2x2',
                'bathrooms'   => 2,
                'bedrooms'    => 2,
                'square_feet' => 984,
                'property_id' => Property::inRandomOrder()->first()->id,
            ]);

            FloorPlan::create([
                'label'       => '3x2',
                'bathrooms'   => 2,
                'bedrooms'    => 3,
                'square_feet' => 1105,
                'property_id' => Property::inRandomOrder()->first()->id,
            ]);

            FloorPlan::create([
                'label'       => '3x3',
                'bathrooms'   => 3,
                'bedrooms'    => 3,
                'square_feet' => 1221,
                'property_id' => Property::inRandomOrder()->first()->id,
            ]);

            FloorPlan::create([
                'label'       => '3x2 (TH)',
                'bathrooms'   => 2,
                'bedrooms'    => 3,
                'square_feet' => 1322,
                'property_id' => Property::inRandomOrder()->first()->id,
            ]);

            FloorPlan::create([
                'label'       => '2x2 (TH)',
                'bathrooms'   => 2,
                'bedrooms'    => 2,
                'square_feet' => 1289,
                'property_id' => Property::inRandomOrder()->first()->id,
            ]);

            FloorPlan::create([
                'label'       => '2x2.5 (TH)',
                'bathrooms'   => 2.5,
                'bedrooms'    => 3,
                'square_feet' => 1198,
                 'property_id' => Property::inRandomOrder()->first()->id,
            ]);
        }
    }
}
