<?php

use App\Setting;
use Illuminate\Database\Seeder;

class SettingTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'logo' => "item/logo.svg",
            'miniLogo' => "item/logo.svg",
            'blog_name' => 'Thailandy',
            'description' => 'Thailandy',
            'address' => 'Thailandy',
            'phone' => '123456789',
        ];

        Setting::create($data);
    }
}
