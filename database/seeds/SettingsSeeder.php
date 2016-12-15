<?php

use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'name' => 'site_name',
            'value' => 'Tech Info 25',
        ]);
        DB::table('settings')->insert([
            'name' => 'maintenance',
            'value' => 'false',
        ]);
        DB::table('settings')->insert([
            'name' => 'facebook_page_url',
            'value' => 'https%3A%2F%2Fwww.facebook.com%2FInfoETE25%2F',
        ]);
        DB::table('settings')->insert([
            'name' => 'portal_activated',
            'value' => 'true',
        ]);
        DB::table('settings')->insert([
            'name' => 'footer',
            'value' => 'ESCOLA TÉCNICA ESTADUAL 25 DE JULHO <br/>IJUÍ - RS',
        ]);
        DB::table('settings')->insert([
            'name' => 'email',
            'value' => 'webmaster@ti25.com',
        ]);
        DB::table('settings')->insert([
            'name' => 'phone',
            'value' => '(55) 55 91234-5678',
        ]);
        DB::table('settings')->insert([
            'name' => 'gmaps_api_key',
            'value' => 'AIzaSyDq39366l6pcisOZmHltpnKpfTg35eVS4A',
        ]);
    }
}