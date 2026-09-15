<?php

namespace Database\Seeders {

    use Illuminate\Database\Seeder;
    use App\Models\FloorPlan;
    use App\Models\Property;
    use App\Models\Unit;

    class UnitSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         */
        public function run(): void
        {
            Unit::create([
                'floor_plan_id' => FloorPlan::inRandomOrder()->first()->id,
                'property_id'   => Property::inRandomOrder()->first()->id,
                'unit_number'   => '1005-129',
            ]);
            Unit::create([
                'floor_plan_id' => FloorPlan::inRandomOrder()->first()->id,
                'property_id'   => Property::inRandomOrder()->first()->id,
                'unit_number'   => '1005-206',
            ]);
            Unit::create([
                'floor_plan_id' => FloorPlan::inRandomOrder()->first()->id,
                'property_id'   => Property::inRandomOrder()->first()->id,
                'unit_number'   => '1005-338',
            ]);
            Unit::create([
                'floor_plan_id' => FloorPlan::inRandomOrder()->first()->id,
                'property_id'   => Property::inRandomOrder()->first()->id,
                'unit_number'   => '1045-362',
            ]);
            Unit::create([
                'floor_plan_id' => FloorPlan::inRandomOrder()->first()->id,
                'property_id'   => Property::inRandomOrder()->first()->id,
                'unit_number'   => '1045-229',
            ]);
            Unit::create([
                'floor_plan_id' => FloorPlan::inRandomOrder()->first()->id,
                'property_id'   => Property::inRandomOrder()->first()->id,
                'unit_number'   => '1045-200',
            ]);
            Unit::create([
                'floor_plan_id' => FloorPlan::inRandomOrder()->first()->id,
                'property_id'   => Property::inRandomOrder()->first()->id,
                'unit_number'   => '1045-268',
            ]);
        }
    }
}
