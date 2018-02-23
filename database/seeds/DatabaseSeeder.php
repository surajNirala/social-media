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
        
        $this->call([
        	UsersTableSeeder::class,
            ProfileTableSeeder::class,
            EducationTableSeeder::class,
            WorkexperienceTableSeeder::class,
        	PostTableSeeder::class,
        	CommentTableSeeder::class,
        ]);
        //factory(App\Model\Post::class,10)->create();
    }
}
