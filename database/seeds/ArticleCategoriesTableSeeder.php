<?php

use App\ArticleCategory;
use Illuminate\Database\Seeder;

class ArticleCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ArticleCategory::create(['name'  =>  'Muebles y Decoración', 'order' => 10]);
        ArticleCategory::create(['name'  =>  'Remodelación', 'order' => 20]);
        ArticleCategory::create(['name'  =>  'Casas', 'order' => 30]);
        ArticleCategory::create(['name'  =>  'Diseño Local e Internacional', 'order' => 40]);
        ArticleCategory::create(['name'  =>  'Paladar', 'order' => 50]);
        ArticleCategory::create(['name'  =>  'Lo que está pasando', 'order' => 60]);
    }
}
