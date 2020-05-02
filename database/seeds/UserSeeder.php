<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
        ]);
    }
}
