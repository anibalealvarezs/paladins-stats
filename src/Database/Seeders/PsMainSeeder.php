<?php

namespace Anibalealvarezs\Paladins\Database\Seeders;

use Illuminate\Database\Seeder;

class PsMainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Permissions Seeder
        $this->call([
            PsModuleSeeder::class,
            PsConfigSeeder::class,
            PsPermissionsSeeder::class,
            PsNavigationSeeder::class,
        ]);
    }
}
