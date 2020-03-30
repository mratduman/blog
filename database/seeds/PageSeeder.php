<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $menus = ["Hakkımda","Kariyer","İletişim"];
      $slugs = ["about","career","contact"];
      $images = [
        "https://static.wixstatic.com/media/03bf8c_526c76c36b774d01b87878138eb2b239~mv2.png",
        "https://github.com/BlackrockDigital/startbootstrap-clean-blog/blob/master/img/home-bg.jpg?raw=true",
        "https://github.com/BlackrockDigital/startbootstrap-clean-blog/blob/master/img/contact-bg.jpg?raw=true"
      ];
      $row = 0;
      foreach ($menus as $menu) {
        DB::table('pages')->insert([
          'title'=>"$menu",
          'image'=>"".$images[$row]."",
          'content'=>"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
          'slug'=>$slugs[$row],
          'order'=>$row,
          'created_at'=>now(),
          'updated_at'=>now()
        ]);
        $row = $row+1;
      }
    }
}
