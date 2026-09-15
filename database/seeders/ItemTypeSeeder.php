<?php

namespace Database\Seeders {

    use Illuminate\Database\Seeder;
    use App\Models\ItemType;

    class ItemTypeSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         */
        public function run(): void
        {
            ItemType::create([
                'name'        => 'Paint',
                'description' => 'Painting task',
                'order'       => 0
            ]);

            ItemType::create([
                'name'        => 'Maintenance',
                'description' => 'Maintenance task',
                'order'       => 1
            ]);

            ItemType::create([
                'name'        => 'Cleaning',
                'description' => 'Cleaning task',
                'order'       => 2
            ]);

            ItemType::create([
                'name'        => 'Carpet',
                'description' => 'Carpet task',
                'order'       => 3
            ]);

            ItemType::create([
                'name'        => 'Pest Control',
                'description' => 'Pest Control task',
                'order'       => 4
            ]);

            ItemType::create([
                'name'        => 'Resurfacing',
                'description' => 'Resurfacing task',
                'order'       => 5
            ]);

            ItemType::create([
                'name'        => 'Other',
                'description' => 'Other task',
                'order'       => 6
            ]);
        }
    }
}
