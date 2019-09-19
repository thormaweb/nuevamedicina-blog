<?php

use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Article::class, 30)->create()->each( function($article) {

            $article->images()->create([
                'url'   =>  'articles/test1.jpg',
                'order' =>  1
            ]);
        });

    }
}
