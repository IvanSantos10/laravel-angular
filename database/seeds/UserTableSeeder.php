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
        factory(\Projeto\User::class)->create([
            'name'=>'Ivan Santos',
            'email'=>'ivanildo.silva@fapema.br',
            'password' => bcrypt(123456),
        ]);
        factory(\Projeto\User::class,10)->create();

        DB::table('oauth_clients')->insert([
            'id'=>'appid01',
            'secret'=>'secret',
            'name'=>'Laraval_angular',
            'created_at'=>Carbon\Carbon::now(),
            'updated_at'=>Carbon\Carbon::now()
        ]);
    }
}



