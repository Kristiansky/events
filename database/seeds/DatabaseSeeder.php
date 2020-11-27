<?php

use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;
    
    class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('categories')->truncate();
        DB::table('events')->truncate();
        
         $this->call(CategoriesTableSeeder::class);
         
         factory(App\Event::class, 20)->create();
    }
}
