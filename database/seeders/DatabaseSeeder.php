<?php

namespace Database\Seeders {

    use Illuminate\Database\Seeder;

    class DatabaseSeeder extends Seeder
    {
        /**
         * Seed the application's database.
         */
        public function run(): void
        {
            $this->call([
                PermissionSeeder::class,
                ItemTypeSeeder::class,
                AdminSeeder::class,
                ManagerSeeder::class,
                SupervisorSeeder::class,
                TechnicianSeeder::class,
                EmployeeSeeder::class,
                // VendorSeeder::class,
                PropertySeeder::class,
                 FloorPlanSeeder::class,
                 UnitSeeder::class,
                // MakeReadySeeder::class,
                // ItemSeeder::class
            ]);
        }
    }
}
