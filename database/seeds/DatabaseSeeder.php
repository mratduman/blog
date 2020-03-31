<?php

use Illuminate\Database\Seeder;
//use DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategorySeeder::class);
        $this->call(ArticleSeeder::class);
        $this->call(PageSeeder::class);
        $this->call(AdminSeeder::class);
    }
}
