<?php

use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Projeto\Entities\Client::truncate();
        factory(\Projeto\Entities\Client::class,10)->create();
    }
}

