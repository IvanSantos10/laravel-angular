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
        \Projeto\Client::truncate();
        factory(\Projeto\Client::class,10)->create();
    }
}

