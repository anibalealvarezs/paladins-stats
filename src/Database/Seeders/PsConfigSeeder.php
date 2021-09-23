<?php

namespace Anibalealvarezs\Paladins\Database\Seeders;

use Anibalealvarezs\Projectbuilder\Models\PbConfig;
use Anibalealvarezs\Projectbuilder\Models\PbModule;
use Illuminate\Database\Seeder;

class PsConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $moduleConfig = PbModule::where('modulekey', 'paladins')->first();
        // Menu Default Config
        // PbConfig::updateOrCreate(['configkey' => '_DUMMY_VAR_'], ['configvalue' => 'value', 'name' => 'Paladins variable', 'description' => 'Paladins variable', 'module_id' => $moduleConfig->id]);
    }
}
