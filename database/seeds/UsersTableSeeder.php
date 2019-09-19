<?php

use App\User;
use App\Role;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $thormaweb = User::create([
            'name'  =>  'Emiliano',
            'email' =>  'info@thormaweb.com',
            'password'  =>  bcrypt('pass'),
        ]);

        $bibi = User::create([
            'name'  =>  'Bibi',
            'email' =>  'info@mododevida.com',
            'password'  =>  bcrypt('pass'),
        ]);

        $emanuel = User::create([
            'name'  =>  'Emanuel',
            'email' =>  'emphotography2016@outlook.com',
            'password'  =>  bcrypt('pass'),
        ]);

        // Attach roles to users
        $admin = Role::where('name', 'admin')->first();
        $manager = Role::where('name', 'manager')->first();

        $thormaweb->attachRole($admin);
        $bibi->attachRole($admin);
        $emanuel->attachRole($manager);

        if (getenv('APP_ENV') == 'local') {
            $demo = User::create([
                'name'  =>  'demo',
                'email' =>  'demo@demo.com',
                'password'  =>  bcrypt('pass'),
            ]);
            $front_user = Role::where('name', 'front_user')->first();
            $demo->attachRole($front_user);
        }
    }
}
