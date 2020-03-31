<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('admins')->insert([
        'name'=>'Murat Duman',
        'email'=>'muratduman2604@gmail.com',
        'password'=>bcrypt(112233),
        'created_at'=>now(),
        'updated_at'=>now()
      ]);
    }
}
