<?php

namespace Database\Seeders {

    use Illuminate\Database\Seeder;
    use App\Models\MakeReadyItem;
    use App\Models\MakeReady;
    use App\Models\ItemType;
    use App\Models\Enums;
    use App\Models\User;

    class ItemSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         */
        public function run(): void
        {
            for ($i = 0; $i < 6; $i++) {
                MakeReadyItem::create([
                    'make_ready_id' => MakeReady::inRandomOrder()->first()->id,
                    'item_type_id'  => ItemType::skip(($i + 1))->first()->id,
                    'assigned_to'   => User::inRandomOrder()->first()->id,
                    'priority'      => fake()->randomElement(Enums\MakeReadyPriority::class),
                    'status'        => fake()->randomElement(Enums\MakeReadyStatus::class),
                ]);
            }
        }
    }
}
