<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserTableSeeder extends Seeder
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

            DB::table('users')->insert(
                array('firstName'	=>	$faker->firstName,
                    'lastName'	    =>	$faker->lastName,
                    'email'	        =>	$faker->email,
                    'password'      =>  Hash::make('123456789'),
                    'role_id'        => $faker->numberBetween(1,6)
                ));

        }
    }
}
