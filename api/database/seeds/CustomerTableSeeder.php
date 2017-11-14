<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,10) as $index) {

            DB::table('customers')->insert(
                array('firstname'	        =>	$faker->firstName,
                    'lastname'	            =>	$faker->lastName,
                    'streetaddress1'	    =>	$faker->streetAddress,
                    'streetaddress2'        =>  $faker->streetAddress,
                    'city'                  =>  $faker->city,
                    'code_poste'            =>  $faker->postcode,
                    'gender'                =>  rand(0, 1),
                    'email'                 =>  $faker->email,
                    'contact_phone'         =>  $faker->phoneNumber
                ));

        }
    }
}


