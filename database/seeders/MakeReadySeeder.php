<?php

namespace Database\Seeders {

    use App\Models\Enums\MakeReadyStatus;
    use Illuminate\Database\Seeder;
    use App\Models\MakeReady;
    use App\Models\Unit;

    class MakeReadySeeder extends Seeder
    {
        /**
         * Run the database seeds.
         */
        public function run(): void
        {
            MakeReady::create([
                'targeted_at' => fake()->dateTimeBetween('now', '+30 days'),
                'moveout_at'  => fake()->dateTimeBetween('now', '+22 days'),
                'unit_id'     => Unit::inRandomOrder()->first()->id,
                'status'      => fake()->randomElement(MakeReadyStatus::class),
            ]);
        }
    }
}
