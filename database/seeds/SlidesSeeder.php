<?php

use App\Slide;
use Illuminate\Database\Seeder;

class SlidesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Slide::create(['slider' => 'home', 'image' => 'slides/slide1.jpg', 'title' => 'Modo de Vida', 'description' => 'Descubre pasadas ediciónes online aquí', 'link' => 'http://revista.mododevida.com', 'order' => 1]);
        Slide::create(['slider' => 'home', 'image' => 'slides/slide2.jpg', 'title' => 'Inspirate!', 'description' => 'Navega nuestras hermosas galerias aquí', 'link' => '#', 'order' => 2]);
    }
}
