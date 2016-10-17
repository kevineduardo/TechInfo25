<?php

use Illuminate\Database\Seeder;

class CategoriesPagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\CategoryPageAttr::class, 5)->create();
    }
}
