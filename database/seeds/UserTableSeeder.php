<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\Projeto\Entities\User::class)->create([
            'name'=>'Ivan Santos',
            'email'=>'ivan@santos.com',
            'password' => bcrypt(123456),
        ]);

        factory(\Projeto\Entities\User::class,10)->create();

    }
}



