<?php

use Illuminate\Database\Seeder;
use App\Setting;

class DevelopmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting = new Setting;
        $setting->id = 'leader_ip';
        $setting->value = '10.151.32.198';
        $setting->save();
    }
}
