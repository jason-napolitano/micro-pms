<?php

namespace Database\Seeders {

    use App\Models\User;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\Hash;
    use Spatie\Permission\Models\Role;

    class EmployeeSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         */
        public function run(): void
        {
            $spectator = Role::create(['name' => env('APP_DEFAULT_ROLE')]);

            // view dashboard
            $spectator->givePermissionTo('view_dashboard');

            // make-readies
            $spectator->givePermissionTo('view_make_ready_board');

            // properties
            $spectator->givePermissionTo('view_properties');
            $spectator->givePermissionTo('view_property');

            // profile
            $spectator->givePermissionTo('view_profile');
            $spectator->givePermissionTo('update_password');
            $spectator->givePermissionTo('update_image');
            $spectator->givePermissionTo('update_email');
            $spectator->givePermissionTo('update_name');

            $user = User::create([
                'name'     => fake()->name(),
                'username' => fake()->username(),
                'email'    => 'spectator@example.com',
                'password' => Hash::make('password'),
                'website'  => fake()->url(),
            ]);
            $user->assignRole(env('APP_DEFAULT_ROLE'));
        }
    }
}
