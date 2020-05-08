<?php

use Illuminate\Database\Seeder;
use App\UserRol\Models\Rol;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'difusor',
            'email' => 'difusor@difusor.com',
            'username' => 'difusor',
            'password' => bcrypt('difusor'),
        ])->rols()->attach([1]);

        $user = User::create([
            'name' => 'autor',
            'email' => 'autor@autor.com',
            'username' => 'autor',
            'password' => bcrypt('autor'),
        ])->rols()->attach([2]);

        /**
        DB::table('users') -> insert([
        	'name' => 'difusor',
        	'email' => 'difusor@difusor.com',
        	'username' => 'difusor',
        	'password' => bcrypt('difusor'),
        ]);
        DB::table('users') -> insert([
        	'name' => 'autor',
        	'email' => 'autor@autor.com',
        	'username' => 'autor',
        	'password' => bcrypt('autor'),
        ]);*/
    }
}
