<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ["Akvaryum","Kitaplık","Gezinti"];

        foreach ($categories as $c) {
          DB::table('categories')->insert([
            'name'=>$c,
            'created_at'=>now(),
            'updated_at'=>now(),
            'slug'=>Str::slug($c)
          ]);
        }
    }
}
