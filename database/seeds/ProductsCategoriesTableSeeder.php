<?php

use App\ProductCategory;
use Illuminate\Database\Seeder;

class ProductsCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Main categories
        ProductCategory::create(['name'  =>  'Productos Decoración', 'parent_id' => NULL, 'is_parent' => true, 'image' => NULL,'order' => 100]);
        ProductCategory::create(['name'  =>  'Productos Remodelación', 'parent_id' => NULL, 'is_parent' => true, 'image' => NULL,'order' => 500]);

        // Subcategories
        ProductCategory::create(['name'  =>  'Sala', 'parent_id' => 1, 'is_parent' => true, 'image' => NULL,'order' => 110]);
        ProductCategory::create(['name'  =>  'Comedor', 'parent_id' => 1, 'is_parent' => true, 'image' => NULL,'order' => 130]);
        ProductCategory::create(['name'  =>  'Dormitorios', 'parent_id' => 1, 'is_parent' => true, 'image' => NULL,'order' => 140]);
        ProductCategory::create(['name'  =>  'Iluminación', 'parent_id' => 1, 'is_parent' => true, 'image' => NULL,'order' => 150]);
        ProductCategory::create(['name'  =>  'Alfombras', 'parent_id' => 1, 'image' => NULL,'order' => 160]);
        ProductCategory::create(['name'  =>  'Telas', 'parent_id' => 1, 'image' => NULL,'order' => 170]);
        ProductCategory::create(['name'  =>  'Empapelados', 'parent_id' => 1, 'image' => NULL,'order' => 170]);
        ProductCategory::create(['name'  =>  'Accesorios', 'parent_id' => 1, 'is_parent' => true, 'image' => NULL,'order' => 170]);
        ProductCategory::create(['name'  =>  'Losas', 'parent_id' => 2, 'image' => NULL,'order' => 510]);
        ProductCategory::create(['name'  =>  'Cocinas', 'parent_id' => 2, 'is_parent' => true, 'image' => NULL,'order' => 520]);
        ProductCategory::create(['name'  =>  'Baños', 'parent_id' => 2, 'is_parent' => true, 'image' => NULL,'order' => 530]);
        ProductCategory::create(['name'  =>  'Otros', 'parent_id' => 2, 'is_parent' => true, 'image' => NULL,'order' => 540]);

        // Child categories Decoración
        ProductCategory::create(['name'  =>  'Sofás', 'parent_id' => 3, 'image' => NULL,'order' => 111]);
        ProductCategory::create(['name'  =>  'Sillas', 'parent_id' => 3, 'image' => NULL,'order' => 112]);
        ProductCategory::create(['name'  =>  'Butacas y otros', 'parent_id' => 3, 'image' => NULL,'order' => 113]);
        ProductCategory::create(['name'  =>  'Mesas', 'parent_id' => 3, 'image' => NULL,'order' => 114]);
        ProductCategory::create(['name'  =>  'Muebles', 'parent_id' => 3, 'image' => NULL,'order' => 115]);
        ProductCategory::create(['name'  =>  'Auxiliares', 'parent_id' => 3, 'image' => NULL,'order' => 116]);

        ProductCategory::create(['name'  =>  'Mesas', 'parent_id' => 4, 'image' => NULL,'order' => 131]);
        ProductCategory::create(['name'  =>  'Sillas', 'parent_id' => 4, 'image' => NULL,'order' => 132]);
        ProductCategory::create(['name'  =>  'Muebles', 'parent_id' => 4, 'image' => NULL,'order' => 133]);
        ProductCategory::create(['name'  =>  'Auxiliares', 'parent_id' => 4, 'image' => NULL,'order' => 134]);

        ProductCategory::create(['name'  =>  'Camas', 'parent_id' => 5, 'image' => NULL,'order' => 141]);
        ProductCategory::create(['name'  =>  'Muebles', 'parent_id' => 5, 'image' => NULL,'order' => 142]);

        ProductCategory::create(['name'  =>  'Colgantes', 'parent_id' => 6, 'image' => NULL,'order' => 151]);
        ProductCategory::create(['name'  =>  'de Mesa', 'parent_id' => 6, 'image' => NULL,'order' => 152]);
        ProductCategory::create(['name'  =>  'de Piso', 'parent_id' => 6, 'image' => NULL,'order' => 153]);
        ProductCategory::create(['name'  =>  'Otras', 'parent_id' => 6, 'image' => NULL,'order' => 154]);

        // Child categories Remodelación
    }
}
