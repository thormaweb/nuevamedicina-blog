<?php

use App\Role;
use App\Permission;
use Illuminate\Database\Seeder;

class RolesAndPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create roles
        $admin = Role::create(['name' => 'admin', 'display_name' => 'Administrador',]);
        $manager = Role::create(['name' => 'manager', 'display_name' => 'Manager',]);
        $shop_editor = Role::create(['name' => 'shop_editor', 'display_name' => 'Editor Tienda',]);
        $blog_editor = Role::create(['name' => 'blog_editor', 'display_name' => 'Editor Blog',]);
        $marketing = Role::create(['name' => 'marketing', 'display_name' => 'Marketing',]);
        $front_user = Role::create(['name' => 'front_user', 'display_name' => 'Usuario',]);

        // Create permissions
        $crudUsers = Permission::create(['name' => 'crudUsers', 'display_name' => 'Gestionar Usuarios',]);
        $accessReports = Permission::create(['name' => 'accessReports', 'display_name' => 'Acceso a Reportes',]);
        $crudVendors = Permission::create(['name' => 'crudVendors', 'display_name' => 'Gestionar Proveedores',]);
        $crudProducts = Permission::create(['name' => 'crudProducts', 'display_name' => 'Gestionar Productos',]);
        $crudArticles = Permission::create(['name' => 'crudArticles', 'display_name' => 'Gestionar Articulos',]);
        $crudSliders = Permission::create(['name' => 'crudSliders', 'display_name' => 'Gestionar Sliders',]);
        $crudAds = Permission::create(['name' => 'crudAds', 'display_name' => 'Gestionar Banners',]);
        $crudnewsletters = Permission::create(['name' => 'crudnewsletters', 'display_name' => 'Gestionar Newsletters',]);


        // Attach permissions to roles
        $admin->attachPermissions([$crudUsers, $accessReports, $crudVendors, $crudProducts, $crudArticles, $crudSliders, $crudAds, $crudnewsletters]);
        $manager->attachPermissions([$accessReports, $crudVendors, $crudProducts, $crudArticles, $crudSliders, $crudAds, $crudnewsletters]);
        $shop_editor->attachPermissions([$crudProducts]);
        $blog_editor->attachPermissions([$crudArticles]);
        $marketing->attachPermissions([$crudAds, $crudnewsletters]);
        $front_user->attachPermissions([]);
    }
}
