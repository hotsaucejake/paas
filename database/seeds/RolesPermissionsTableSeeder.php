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
            'view_permanent_placements', 'add_permanent_placements', 'edit_permanent_placements', 'delete_permanent_placements',
            'view_contract_billings', 'add_contract_billings', 'edit_contract_billings', 'delete_contract_billings',
        ];

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
        }

        $users = User::all();

        foreach($users as $user){
            $user->assignRole('inactive');
        }

        $super = User::find(1);
        $super->assignRole('super-admin');
    }
}
