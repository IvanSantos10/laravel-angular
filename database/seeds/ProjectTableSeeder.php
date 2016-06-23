<?php

use Illuminate\Database\Seeder;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //\Projeto\Entities\Project::truncate();
        factory(\Projeto\Entities\Project::class,10)->create();
    }
}

