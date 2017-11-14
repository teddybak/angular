<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class OrdersTableSeeder extends Seeder
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

            DB::table('orders')->insert(
                array('user_id'	        =>	$faker->numberBetween(2,6),
                    'retailer_id'	    =>	$faker->numberBetween(1,5),
                    'status'	        =>	$faker->randomElement($array = array ('Not Assigned','In Progress','Rejected','Aborted','Completed','Cancelled','Deleted')),
                    'total'             =>  $faker->randomFloat(7,2)
                ));

        }
    }
}