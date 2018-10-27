<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class RolesPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        $roles = ['super-admin', 'admin', 'active', 'inactive'];
        $permissions = [
            'view_users', 'add_users', 'edit_users', 'delete_users',
            'view_roles', 'add_roles', 'edit_roles', 'delete_roles',
            'view_permissions', 'add_permissions', 'edit_permissions', 'delete_permissions',
            'view_permanent_placements', 'add_permanent_placements', 'edit_permanent_placements', 'delete_permanent_placements', 'approve_permanent_placements',
            'view_contract_billings', 'add_contract_billings', 'edit_contract_billings', 'delete_contract_billings', 'approve_contract_billings',
            'view_distribution_emails', 'add_distribution_emails', 'edit_distribution_emails', 'delete_distribution_emails',
            'view_distribution_lists', 'add_distribution_lists', 'edit_distribution_lists', 'delete_distribution_lists',
        ];

        $admin_permissions = [
            'view_users', 'add_users', 'edit_users',
            'view_roles', 'add_roles', 'edit_roles',
            'view_permissions',
            'view_permanent_placements', 'add_permanent_placements', 'edit_permanent_placements', 'delete_permanent_placements', 'approve_permanent_placements',
            'view_contract_billings', 'add_contract_billings', 'edit_contract_billings', 'delete_contract_billings', 'approve_contract_billings',
            'view_distribution_emails', 'add_distribution_emails', 'edit_distribution_emails', 'delete_distribution_emails',
            'view_distribution_lists', 'add_distribution_lists', 'edit_distribution_lists', 'delete_distribution_lists',
        ];

        $active_permissions = [
            'view_permanent_placements', 'add_permanent_placements',
            'view_contract_billings', 'add_contract_billings',
        ];

        $active_users = [5,6,8,12,13,16,17,18,19,20,22,23,24,25,27,28,29,30,31,32,35,36];
        $admins = [3,14,21,26,33,34];

        foreach($permissions as $permission)
        {
            Permission::create(['name' => $permission]);
        }

        foreach($roles as $role)
        {
            $newRole = Role::create(['name' => $role]);
            if($role == 'super-admin')
            {
                $newRole->syncPermissions($permissions);
            }
            if($role == 'admin')
            {
                $newRole->syncPermissions($admin_permissions);
            }
            if($role == 'active')
            {
                $newRole->syncPermissions($active_permissions);
            }
        }

        $users = User::all();

        foreach($users as $user){
            $user->assignRole('inactive');
        }

        foreach($active_users as $active)
        {
            $user = User::find($active);
            $user->syncRoles('active');
        }

        foreach($admins as $admin)
        {
            $user = User::find($admin);
            $user->syncRoles('admin');
        }

        $super = User::find(1);
        $super->syncRoles('super-admin');
    }
}
