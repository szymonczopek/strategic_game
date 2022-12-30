<?php

namespace Database\Seeders;

use App\Models\BonusBuildingName;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            ['id'=>1, 'name'=>'DRWAL'],
            ['id'=>2,'name'=>'KAMIENIARZ'],
            ['id'=>3,'name'=>'MŁYN'],
            ['id'=>4,'name'=>'INŻYNIER'],
            ['id'=>5,'name'=>'ARCHITEKT'],

        ];
        BonusBuildingName::insert($data);
    }
}
