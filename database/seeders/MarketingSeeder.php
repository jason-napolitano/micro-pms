<?php

namespace Database\Seeders {

    use App\Models\User;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\Hash;
    use Spatie\Permission\Models\Role;

    class MarketingSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         */
        public function run(): void
        {
            $marketing = Role::create(['name' => env('APP_DEFAULT_ROLE')]);

            // view dashboard
            $marketing->givePermissionTo('view_dashboard');

            // make-readies
            $marketing->givePermissionTo('view_make_ready_board');
            $marketing->givePermissionTo('create_make_ready');

            // properties
            $marketing->givePermissionTo('view_properties');
            $marketing->givePermissionTo('view_property');

            // profile
            $marketing->givePermissionTo('update_profile_image');
            $marketing->givePermissionTo('update_password');
            $marketing->givePermissionTo('update_profile');
            $marketing->givePermissionTo('view_profile');
            $marketing->givePermissionTo('update_email');
            $marketing->givePermissionTo('update_name');

            /*
            $user = User::create([
                'name'     => fake()->name(),
                'username' => fake()->username(),
                'email'    => 'marketing@example.com',
                'password' => Hash::make('password'),
                'website'  => fake()->url(),
            ]);
            $user->assignRole($marketing);
            */
        }
    }
}
