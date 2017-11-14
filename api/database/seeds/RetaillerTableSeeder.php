<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class RetaillerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,5) as $index) {

            DB::table('retailers')->insert(
                array('name'	    =>	$faker->company,
                    'location'	    =>	$faker->city,
                    'email'	        =>	$faker->email,
                    'secret'        =>  $faker->randomNumber()
                ));

        }
    }
}
