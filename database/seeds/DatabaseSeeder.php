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
        $this->call(RolesAndPermissionsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ArticleCategoriesTableSeeder::class);

        if (getenv('APP_ENV') == 'local') {
            $this->call(ArticlesTableSeeder::class);
            $this->call(SlidesSeeder::class);
        }
    }
}
