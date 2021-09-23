<?php

namespace Anibalealvarezs\Paladins\Database\Seeders;

use Anibalealvarezs\Projectbuilder\Models\PbModule;
use Anibalealvarezs\Projectbuilder\Models\PbRole;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PsPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $moduleMenu = PbModule::where('modulekey', 'paladins')->first();

        // create permissions
        Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'config paladins'], ['alias' => 'Configure Paladins', 'module_id' => $moduleMenu->id]);
        Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'create paladins'], ['alias' => 'Create Paladins', 'module_id' => $moduleMenu->id]);
        Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'read paladins'], ['alias' => 'Read Paladins', 'module_id' => $moduleMenu->id]);
        Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'update paladins'], ['alias' => 'Update Paladins', 'module_id' => $moduleMenu->id]);
        Permission::updateOrCreate(['guard_name' => 'admin', 'name' => 'delete paladins'], ['alias' => 'Delete Paladins', 'module_id' => $moduleMenu->id]);
        $filePermissions = [
            'create paladins', 'read paladins', 'update paladins', 'delete paladins', 'config paladins',
        ];

        // assign privileges to default Project Builder roles
        // Super Admin
        $superAdminRole = PbRole::where('name', 'super-admin')->first();
        if ($superAdminRole) {
            $superAdminRole->givePermissionTo($filePermissions);
        }
        // Admin
        $adminRole = PbRole::where('name', 'admin')->first();
        if ($adminRole) {
            $superAdminRole->givePermissionTo($filePermissions);
        }
    }
}
