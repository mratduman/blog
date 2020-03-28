<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i=0; $i < 10; $i++) {
          $title = $faker->sentence(6);
          DB::table('articles')->insert([
            'category'=>rand(1,3),
            'title'=>$title,
            'image'=>$faker->imageUrl(800, 400, 'cats', true, 'Kediler'),
            'content'=>$faker->paragraph(25),
            'slug'=>Str::slug($title),
            'created_at'=>now(),
            'updated_at'=>now()
          ]);
        }
    }
}
