<?php

namespace Database\Seeders {

    use App\Models\User;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\Hash;
    use Spatie\Permission\Models\Role;

    class TechnicianSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         */
        public function run(): void
        {
            $technician = Role::create(['name' => 'technician']);

            // make-ready items
            $technician->givePermissionTo('update_make_ready_item_status');
            $technician->givePermissionTo('update_make_ready_item_notes');
            $technician->givePermissionTo('schedule_make_ready_item');
            $technician->givePermissionTo('update_make_ready_item');
            $technician->givePermissionTo('assign_make_ready_item');

            // properties
            $technician->givePermissionTo('view_properties');
            $technician->givePermissionTo('view_property');

            // make-readies
            $technician->givePermissionTo('view_make_ready_board');
            $technician->givePermissionTo('view_make_ready');
            $technician->givePermissionTo('update_make_ready');

            // profile
            $technician->givePermissionTo('view_profile');
            $technician->givePermissionTo('update_password');
            $technician->givePermissionTo('update_image');
            $technician->givePermissionTo('update_email');
            $technician->givePermissionTo('update_name');

            $user = User::create([
                'name'     => fake()->name(),
                'username' => fake()->username(),
                'email'    => 'technician@example.com',
                'password' => Hash::make('password'),
                'website'  => fake()->url(),
            ]);
            $user->assignRole('technician');
        }
    }
}
