<?php

namespace Anibalealvarezs\Paladins\Database\Seeders;

use Anibalealvarezs\Projectbuilder\Models\PbModule;
use Anibalealvarezs\Projectbuilder\Models\PbNavigation as Navigation;
use Anibalealvarezs\Projectbuilder\Models\PbPermission;
use Illuminate\Database\Seeder;

class PsNavigationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get Permissions
        $readPaladinsPermission = PbPermission::where('name', 'read paladins')->first();
        $modulePaladins = PbModule::where('modulekey', 'paladins')->first();

        // Parents
        $paladinsParent = Navigation::updateOrCreate(['name' => 'Paladins'], ['destiny' => '#navigation-paladins', 'type' => 'custom', 'parent' => 0, 'permission_id' => $readPaladinsPermission->id, 'position' => 0, 'module_id' => $modulePaladins->id]);

        // Children
        if ($paladinsParent) {
            Navigation::updateOrCreate(['name' => 'Paladins'], ['destiny' => 'paladins.index', 'type' => 'route', 'parent' => $paladinsParent->id, 'permission_id' => $readPaladinsPermission->id, 'position' => 0, 'module_id' => $modulePaladins->id]);
        }
    }
}
