<?php

use Illuminate\Database\Seeder;

class WorkexperienceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Model\Workexperience::class, 2)->create();
    }
}
