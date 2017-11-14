<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
            DB::table('roles')->insert( array('name'	=>	'admin'));
            DB::table('roles')->insert( array('name'	=>	'level 1'));
            DB::table('roles')->insert( array('name'	=>	'level 2'));
            DB::table('roles')->insert( array('name'	=>	'level 3'));
            DB::table('roles')->insert( array('name'	=>	'level 4'));
    }
}
