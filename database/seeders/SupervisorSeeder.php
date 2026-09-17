<?php

namespace Database\Seeders {

    use App\Models\User;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\Hash;
    use Spatie\Permission\Models\Role;

    class SupervisorSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         */
        public function run(): void
        {
            // make-readies
            $supervisor = Role::create(['name' => 'supervisor']);

            // properties
            $supervisor->givePermissionTo('view_properties');
            $supervisor->givePermissionTo('view_property');

            // make-readies
            $supervisor->givePermissionTo('update_make_ready_item_status');
            $supervisor->givePermissionTo('update_make_ready_item_notes');
            $supervisor->givePermissionTo('update_make_ready_status');
            $supervisor->givePermissionTo('schedule_make_ready_item');
            $supervisor->givePermissionTo('update_make_ready_item');
            $supervisor->givePermissionTo('assign_make_ready_item');
            $supervisor->givePermissionTo('filter_make_ready_items');
            $supervisor->givePermissionTo('view_make_ready_board');
            $supervisor->givePermissionTo('view_make_readies');
            $supervisor->givePermissionTo('view_make_ready');
            $supervisor->givePermissionTo('create_make_ready');
            $supervisor->givePermissionTo('update_make_ready');
            $supervisor->givePermissionTo('delete_make_ready');

            // profile
            $supervisor->givePermissionTo('update_profile_image');
            $supervisor->givePermissionTo('update_password');
            $supervisor->givePermissionTo('update_profile');
            $supervisor->givePermissionTo('view_profile');
            $supervisor->givePermissionTo('update_email');
            $supervisor->givePermissionTo('update_name');

            /*
            $user = User::create([
                'name'     => fake()->name(),
                'username' => fake()->username(),
                'email'    => 'supervisor@example.com',
                'password' => Hash::make('password'),
                'website'  => fake()->url(),
            ]);
            $user->assignRole($supervisor);
            */
        }
    }
}
