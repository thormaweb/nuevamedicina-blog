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
        $this->call(ColorsTableSeeder::class);
        $this->call(RoomsTableSeeder::class);
        $this->call(ProductsCategoriesTableSeeder::class);
        $this->call(ArticleCategoriesTableSeeder::class);
        $this->call(MagazineTableSeeder::class);

        if (getenv('APP_ENV') == 'local') {
            $this->call(VendorsTableSeeder::class);
            $this->call(ProductsTableSeeder::class);
            $this->call(ArticlesTableSeeder::class);
            $this->call(SlidesSeeder::class);
        }
    }
}
