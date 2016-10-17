<?php
// Copyright (C) 2016  Kevin Souza
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(TeachersTableSeeder::class);
        //$this->call(CategoryTableSeeder::class);
        //$this->call(PagesTableSeeder::class);
        //$this->call(CategoriesPagesSeeder::class);
        $this->call(SettingsSeeder::class);
        $this->call(PicturesTableSeeder::class);
        $this->call(CalendarSeeder::class);
        $this->call(DefaultDataSeeder::class);
    }
}
