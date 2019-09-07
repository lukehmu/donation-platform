<?php

use Illuminate\Database\Seeder;

class DonationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Donation::class, 10)->create();
    }
}
