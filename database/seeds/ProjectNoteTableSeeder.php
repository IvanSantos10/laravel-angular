<?php

use Illuminate\Database\Seeder;

class ProjectNoteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //\Projeto\Entities\Project::truncate();
        factory(\Projeto\Entities\ProjectNote::class,50)->create();
    }
}

