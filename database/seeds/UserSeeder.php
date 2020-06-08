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
            'name' => 'difusor1',
            'email' => 'difusor1@difusor.com',
            'username' => 'difusor1',
            'password' => bcrypt('difusor1'),
        ])->rols()->attach([1]);

        $user = User::create([
            'name' => 'autor',
            'email' => 'autor@autor.com',
            'username' => 'autor',
            'password' => bcrypt('autor'),
        ])->rols()->attach([2]);

        $user = User::create([
            'name' => 'autor1',
            'email' => 'autor1@autor.com',
            'username' => 'autor1',
            'password' => bcrypt('autor1'),
        ])->rols()->attach([2]);

        $user = User::create([
            'name' => 'autor2',
            'email' => 'autor2@autor.com',
            'username' => 'autor2',
            'password' => bcrypt('autor2'),
        ])->rols()->attach([2]);

        $user = User::create([
            'name' => 'autor3',
            'email' => 'autor3@autor.com',
            'username' => 'autor3',
            'password' => bcrypt('autor3'),
        ])->rols()->attach([2]);

        //$autor = User::find(2);
        //$autor->categoria()->attach([1]);

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
