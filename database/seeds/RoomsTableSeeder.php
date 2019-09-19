<?php

use App\Room;
use Illuminate\Database\Seeder;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Room::create(['name'  =>  'Recibidor', 'order' => 10]);
        Room::create(['name'  =>  'Sala', 'order' => 20]);
        Room::create(['name'  =>  'Comedor', 'order' => 30]);
        Room::create(['name'  =>  'Salon de estar', 'order' => 40]);
        Room::create(['name'  =>  'Habitación', 'order' => 50]);
        Room::create(['name'  =>  'Cocina', 'order' => 60]);
        Room::create(['name'  =>  'Baño', 'order' => 70]);
        Room::create(['name'  =>  'Terraza', 'order' => 80]);
        Room::create(['name'  =>  'Gazebo', 'order' => 90]);
        Room::create(['name'  =>  'Piscina', 'order' => 100]);
        Room::create(['name'  =>  'Barra', 'order' => 110]);
        Room::create(['name'  =>  'Oficina', 'order' => 120]);
        Room::create(['name'  =>  'Jardin', 'order' => 130]);
        Room::create(['name'  =>  'Nursery', 'order' => 140]);
        Room::create(['name'  =>  'Cava de vinos', 'order' => 150]);
        Room::create(['name'  =>  'Man cave', 'order' => 160]);
        Room::create(['name'  =>  'Salon de juegos', 'order' => 170]);
        Room::create(['name'  =>  'Gimnasio', 'order' => 180]);
        Room::create(['name'  =>  'Closet', 'order' => 190]);
    }
}
