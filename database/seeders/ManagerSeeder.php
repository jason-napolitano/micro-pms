<?php

namespace Database\Seeders {

    use App\Models\User;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\Hash;
    use Spatie\Permission\Models\Role;

    class ManagerSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         */
        public function run(): void
        {
            // manager
            $manager = Role::create(['name' => 'property_manager']);

            // settings
            $manager->givePermissionTo('view_settings');

            // dashboard
            $manager->givePermissionTo('view_dashboard');

            // properties
            $manager->givePermissionTo('view_properties');
            $manager->givePermissionTo('view_property');

            // make-readies
            $manager->givePermissionTo('update_make_ready_item_status');
            $manager->givePermissionTo('update_make_ready_item_notes');
            $manager->givePermissionTo('update_make_ready_status');
            $manager->givePermissionTo('schedule_make_ready_item');
            $manager->givePermissionTo('filter_make_ready_items');
            $manager->givePermissionTo('update_make_ready_item');
            $manager->givePermissionTo('assign_make_ready_item');
            $manager->givePermissionTo('view_make_ready_board');
            $manager->givePermissionTo('view_make_readies');
            $manager->givePermissionTo('create_make_ready');
            $manager->givePermissionTo('update_make_ready');
            $manager->givePermissionTo('delete_make_ready');
            $manager->givePermissionTo('view_make_ready');

            // units
            $manager->givePermissionTo('create_unit');
            $manager->givePermissionTo('update_unit');
            $manager->givePermissionTo('delete_unit');
            $manager->givePermissionTo('view_units');
            $manager->givePermissionTo('view_unit');

            // vendors
            $manager->givePermissionTo('update_vendor');
            $manager->givePermissionTo('view_vendors');
            $manager->givePermissionTo('view_vendor');

            // floor-plans
            $manager->givePermissionTo('create_floor_plan');
            $manager->givePermissionTo('update_floor_plan');
            $manager->givePermissionTo('delete_floor_plan');
            $manager->givePermissionTo('view_floor_plans');
            $manager->givePermissionTo('view_floor_plan');

            // profile
            $manager->givePermissionTo('delete_profiles');
            $manager->givePermissionTo('update_password');
            $manager->givePermissionTo('delete_profile');
            $manager->givePermissionTo('view_profile');
            $manager->givePermissionTo('update_email');
            $manager->givePermissionTo('update_image');
            $manager->givePermissionTo('update_name');

            // users
            $manager->givePermissionTo('update_user');
            $manager->givePermissionTo('view_users');
            $manager->givePermissionTo('view_user');

            $user = User::create([
                'name'     => fake()->name(),
                'username' => fake()->username(),
                'email'    => 'manager@example.com',
                'password' => Hash::make('password'),
                'website'  => fake()->url(),
            ]);
            $user->assignRole('property_manager');
        }
    }
}
