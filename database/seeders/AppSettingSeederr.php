<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AppSetting;

class AppSettingSeederr extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jsonString = file_get_contents(base_path('database/seeder-data/app-setting.json'));

        $dataArr = json_decode($jsonString, true);

        foreach ($dataArr as $data) {
            AppSetting::updateOrCreate(
                [
                    'type' => $data['type'],
                    'field' => $data['field'],
                    'value' => $data['value']
                ]
            );
        }
    }
}
