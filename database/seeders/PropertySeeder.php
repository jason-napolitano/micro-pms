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
            $marc = Property::create([
                'address' => '1045 Armorlite Dr. San Marcos CA 92069',
                'phone'   => fake()->phoneNumber(),
                'name'    => 'Marc Apartments',
                'code'    => 'MRC',
            ]);
            /*
            $rylan = Property::create([
                'address' => '100 Main St, Vista, CA 92083',
                'phone'   => fake()->phoneNumber(),
                'name'    => 'Rylan Apartments',
                'code'    => 'RYL',
            ]);
            $blockC = Property::create([
                'address' => '250 North City Dr, San Marcos, CA 92078',
                'phone'   => fake()->phoneNumber(),
                'name'    => 'Block C Apartments',
                'code'    => 'BLKC',
            ]);
            */

            $marc->users()->attach(User::role('admin')->first());
//            $rylan->users()->attach(User::role('admin')->first());
//            $blockC->users()->attach(User::role('admin')->first());
        }
    }
}
