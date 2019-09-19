<?php

use App\Color;
use Illuminate\Database\Seeder;

class ColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Color::create(['name'  =>  'Negro', 'sample' =>  'negro.png', 'order' => 10]);
        Color::create(['name'  =>  'Blanco', 'sample' =>  'blanco.png', 'order' => 20]);
        Color::create(['name'  =>  'Crema', 'sample' =>  'crema.png', 'order' => 30]);
        Color::create(['name'  =>  'Marrón', 'sample' =>  'marron.png', 'order' => 40]);
        Color::create(['name'  =>  'Gris', 'sample' =>  'gris.png', 'order' => 50]);
        Color::create(['name'  =>  'Charcoal gray', 'sample' =>  'charcoal-gray.png', 'order' => 60]);
        Color::create(['name'  =>  'Azul', 'sample' =>  'azul.png', 'order' => 70]);
        Color::create(['name'  =>  'Turquesa', 'sample' =>  'turquesa.png', 'order' => 80]);
        Color::create(['name'  =>  'Teal', 'sample' =>  'teal.png', 'order' => 90]);
        Color::create(['name'  =>  'Verde', 'sample' =>  'verde.png', 'order' => 100]);
        Color::create(['name'  =>  'Lima', 'sample' =>  'lima.png', 'order' => 110]);
        Color::create(['name'  =>  'Amarillo', 'sample' =>  'amarillo.png', 'order' => 120]);
        Color::create(['name'  =>  'Anaranjado', 'sample' =>  'anaranjado.png', 'order' => 130]);
        Color::create(['name'  =>  'Ladrillo', 'sample' =>  'ladrillo.png', 'order' => 140]);
        Color::create(['name'  =>  'Rojo', 'sample' =>  'rojo.png', 'order' => 150]);
        Color::create(['name'  =>  'Violeta', 'sample' =>  'violeta.png', 'order' => 160]);
        Color::create(['name'  =>  'Rosado', 'sample' =>  'mosado.png', 'order' => 170]);
        Color::create(['name'  =>  'Multicolor', 'sample' =>  'multicolor.png', 'order' => 180]);
    }
}
