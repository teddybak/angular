<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $this->call(UserTableSeeder::class);
            $this->call(OrdersTableSeeder::class);
            $this->call(RetaillerTableSeeder::class);
            $this->call(RoleTableSeeder::class);
    }
}
