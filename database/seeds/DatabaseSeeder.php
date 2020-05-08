<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CategoriasSeeder::class);
        $this->call(LibrosSeeder::class);
        $this->call(VersionesSeeder::class);
    }
}
