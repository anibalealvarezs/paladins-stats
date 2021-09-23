<?php

namespace Anibalealvarezs\Paladins\Database\Seeders;

use Anibalealvarezs\Projectbuilder\Models\PbModule as Module;
use Illuminate\Database\Seeder;

class PsModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Module::updateOrCreate(['modulekey' => 'paladins'], ['name' => 'Paladins Statistics', 'status' => 1]);
    }
}
