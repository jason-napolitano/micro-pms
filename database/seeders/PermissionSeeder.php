<?php

namespace Database\Seeders {

    use Spatie\Permission\Models\Permission;
    use Illuminate\Database\Seeder;

    class PermissionSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         */
        public function run(): void
        {
            // --------------------------------------------
            // settings
            Permission::create(['name' => 'view_settings']);

            // --------------------------------------------
            // dashboard
            Permission::create(['name' => 'view_dashboard']);

            // --------------------------------------------
            // regions
            Permission::create(['name' => 'view_regions']);
            Permission::create(['name' => 'view_region']);
            Permission::create(['name' => 'create_region']);
            Permission::create(['name' => 'update_region']);
            Permission::create(['name' => 'delete_region']);

            // --------------------------------------------
            // users
            Permission::create(['name' => 'view_users']);
            Permission::create(['name' => 'view_user']);
            Permission::create(['name' => 'create_user']);
            Permission::create(['name' => 'update_user']);
            Permission::create(['name' => 'delete_user']);

            // --------------------------------------------
            // access control
            Permission::create(['name' => 'view_access_control']);

            // --------------------------------------------
            // roles
            Permission::create(['name' => 'view_roles']);
            Permission::create(['name' => 'view_role']);
            Permission::create(['name' => 'create_role']);
            Permission::create(['name' => 'update_role']);
            Permission::create(['name' => 'delete_role']);

            // --------------------------------------------
            // permissions
            Permission::create(['name' => 'view_permissions']);
            Permission::create(['name' => 'view_permission']);
            Permission::create(['name' => 'create_permission']);
            Permission::create(['name' => 'update_permission']);
            Permission::create(['name' => 'delete_permission']);

            // --------------------------------------------
            // properties
            Permission::create(['name' => 'view_properties']);
            Permission::create(['name' => 'view_property']);
            Permission::create(['name' => 'create_property']);
            Permission::create(['name' => 'update_property']);
            Permission::create(['name' => 'delete_property']);

            // --------------------------------------------
            // make-ready items
            Permission::create(['name' => 'update_make_ready_item_status']);
            Permission::create(['name' => 'update_make_ready_item_notes']);
            Permission::create(['name' => 'schedule_make_ready_item']);
            Permission::create(['name' => 'update_make_ready_status']);
            Permission::create(['name' => 'filter_make_ready_items']);
            Permission::create(['name' => 'assign_make_ready_item']);
            Permission::create(['name' => 'update_make_ready_item']);

            // --------------------------------------------
            // make-readies
            Permission::create(['name' => 'view_make_ready_board']);
            Permission::create(['name' => 'view_make_readies']);
            Permission::create(['name' => 'view_make_ready']);
            Permission::create(['name' => 'create_make_ready']);
            Permission::create(['name' => 'update_make_ready']);
            Permission::create(['name' => 'delete_make_ready']);

            // --------------------------------------------
            // units
            Permission::create(['name' => 'view_units']);
            Permission::create(['name' => 'view_unit']);
            Permission::create(['name' => 'create_unit']);
            Permission::create(['name' => 'update_unit']);
            Permission::create(['name' => 'delete_unit']);

            // --------------------------------------------
            // vendors
            Permission::create(['name' => 'view_vendors']);
            Permission::create(['name' => 'view_vendor']);
            Permission::create(['name' => 'create_vendor']);
            Permission::create(['name' => 'update_vendor']);
            Permission::create(['name' => 'delete_vendor']);

            // --------------------------------------------
            // floor-plans
            Permission::create(['name' => 'view_floor_plans']);
            Permission::create(['name' => 'view_floor_plan']);
            Permission::create(['name' => 'create_floor_plan']);
            Permission::create(['name' => 'update_floor_plan']);
            Permission::create(['name' => 'delete_floor_plan']);

            // --------------------------------------------
            // profile
            Permission::create(['name' => 'delete_profiles']);
            Permission::create(['name' => 'update_password']);
            Permission::create(['name' => 'view_profile']);
            Permission::create(['name' => 'delete_profile']);
            Permission::create(['name' => 'update_email']);
            Permission::create(['name' => 'update_image']);
            Permission::create(['name' => 'update_name']);

            // admin wildcard
            Permission::create(['name' => '*']);
        }
    }
}
