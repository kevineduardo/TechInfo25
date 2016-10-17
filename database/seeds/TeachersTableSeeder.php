<?php
// Copyright (C) 2016  Kevin Souza
use Illuminate\Database\Seeder;

class TeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Teacher::class, 1)->create();
    }
}
