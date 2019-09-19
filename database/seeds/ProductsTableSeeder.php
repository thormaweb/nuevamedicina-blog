<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Product::class, 50)->create()->each( function($product) {

            $colors_ids = \DB::table('colors')->select('id')->orderByRaw('RAND()')->limit(5)->get()->keyBy('id');
            $colors_ids->each(function ($item, $key) use ($product) {

                $product->colors()->attach($key);
            });

            $room_ids = \DB::table('rooms')->select('id')->orderByRaw('RAND()')->limit(5)->get()->keyBy('id');
            $room_ids->each(function ($item, $key) use ($product) {

                $product->rooms()->attach($key);
            });

            $product->images()->create([
                'url'   =>  'product/test1.jpg',
                'order' =>  1
            ]);
        });
    }
}
