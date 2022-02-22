<?php

namespace Edwin\Edwinpermisos;

use Illuminate\Database\Seeder;

use App\Models\User;
use Edwin\Edwinpermisos\Models\Role;
use Edwin\Edwinpermisos\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class espgPermissionInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //truncate
        DB::statement('SET foreign_key_checks=0');
        DB::table('role_user')->truncate();
        DB::table('permission_role')->truncate();

        Permission::truncate();
        Role::truncate();
        DB::statement('SET foreign_key_checks=1');

        //user admin
        $useradmin = User::where('email', 'admin@admin.com')->first();
        if ($useradmin) {
            $useradmin->delete();
        }
        $useradmin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
        ]);

        $roleadmin = Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
            'description' => 'administrador',
            'full-access' => 'yes'
        ]);

        $roleregistered = Role::create([
            'name' => 'Registered',
            'slug' => 'registered',
            'description' => 'registered',
            'full-access' => 'no'
        ]);

        //roles usuarios
        $useradmin->roles()->sync([$roleadmin->id]);

        //permission
        $permission_all = [];

        $permission = Permission::create([
            'name' => 'List Role',
            'slug' => 'role.index',
            'description' => 'list Roles'
        ]);

        $permission_all[] = $permission->id;

        $permission = Permission::create([
            'name' => 'Show Role',
            'slug' => 'role.show',
            'description' => 'show Roles'
        ]);

        $permission_all[] = $permission->id;

        $permission = Permission::create([
            'name' => 'create Role',
            'slug' => 'role.create',
            'description' => 'create Roles'
        ]);

        $permission_all[] = $permission->id;

        $permission = Permission::create([
            'name' => 'Edit Role',
            'slug' => 'role.edit',
            'description' => 'Edit Roles'
        ]);

        $permission_all[] = $permission->id;

        $permission = Permission::create([
            'name' => 'Destroy Role',
            'slug' => 'role.destroy',
            'description' => 'Destroy Roles'
        ]);

        $permission_all[] = $permission->id;

        $permission = Permission::create([
            'name' => 'List User',
            'slug' => 'user.index',
            'description' => 'list Users'
        ]);

        $permission_all[] = $permission->id;

        $permission = Permission::create([
            'name' => 'Show User',
            'slug' => 'user.show',
            'description' => 'show Users'
        ]);

        $permission_all[] = $permission->id;

        $permission = Permission::create([
            'name' => 'create User',
            'slug' => 'user.create',
            'description' => 'create Users'
        ]);

        $permission_all[] = $permission->id;

        $permission = Permission::create([
            'name' => 'Edit User',
            'slug' => 'user.edit',
            'description' => 'Edit Users'
        ]);

        $permission_all[] = $permission->id;

        $permission = Permission::create([
            'name' => 'Destroy User',
            'slug' => 'user.destroy',
            'description' => 'Destroy Users'
        ]);

        $permission_all[] = $permission->id;

        $permission = Permission::create([
            'name' => 'Show own User',
            'slug' => 'userown.show',
            'description' => 'show  own Users'
        ]);

        $permission_all[] = $permission->id;


        $permission = Permission::create([
            'name' => 'Edit own User',
            'slug' => 'userown.edit',
            'description' => 'Edit own Users'
        ]);

        $permission_all[] = $permission->id;

        //permission roles
        $roleadmin->permissions()->sync($permission_all);
    }
}
